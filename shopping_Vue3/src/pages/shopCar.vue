<template>
    <div class="container-fluid shopCar">
        <div class="cart-text">
            <span>购物车内有</span>
            <span class="number">{{ n }}</span>
            <span>件商品</span>
            <a class="clear" href="javascript:;" @click="clearCar">清空购物车</a>


        </div>
        <div class="content" v-if="!ishave">
            <div class="no-itembox">
                <i class="icon-cart"></i>
                <span>你的购物车什么都没有！</span>
            </div>
        </div>
        <div class="proContent">
            <div class="list">
                <div class="priceSum" v-if="ishave">
                    <div class="priceSum-t">
                        <div class="priceSum-t-1">
                            <span class="left">小计</span>
                            <span class="right">￥{{ total }}</span>
                        </div>
                        <div class="priceSum-t-2">
                            <span class="left">总计</span>
                            <span class="right">￥{{ total }}</span>
                        </div>
                    </div>
                    <button class="endbtn" @click="purchase()">结算</button>
                    <div class="mobliebtn">
                        <div class="btn-left">
                            <span class="btn-left-1">总计</span>
                            <span class="btn-left-2">{{ total }}</span>
                        </div>
                        <button class="btn-right" @click="purchase()">结算</button>
                    </div>
                    <p class="priceSum-m">
                        支付宝/花呗分期/掌上生活/银联分期/微信
                    </p>
                    <div class="priceSum-b">
                        <div class="priceSum-b-1">
                            <div class="sale1">
                                <span class="icon-portfolio"></span>
                                <span class="text">60天退换货</span>
                            </div>
                            <div class="sale1">
                                <span class="icon-travel-bus"></span>
                                <span class="text">60天退换货</span>
                            </div>
                            <div class="sale1">
                                <span class="icon-phone_in_talk"></span>
                                <span class="text">60天退换货</span>
                            </div>
                        </div>
                        <p class="priceSum-b-2">
                            全场包邮，16:00前订单当日发货，页面有提示或特殊情况除外。
                        </p>
                        <p class="priceSum-b-3">
                            Office、Windows等电子下载版软件产品，一经过售出不予退换。
                        </p>
                    </div>
                </div>

                <table v-if="ishave">
                    <tbody v-for="c in cart">
                        <tr class="package">
                            <td>
                                <div class="package-name">{{ c.name }}</div>
                                <div class="package-price"><span class="all-price">{{ (c.price * c.quantity).toFixed(2) }}</span> </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="shopping indexk">

                                <div class="shopping-left">
                                    <img :src="'http://localhost/project_PHP/' + c.imgName.split(',')[0]" alt="">
                                    <a class="delete" href="javascript:;" @click="isdelete(c.cartId)">删除商品</a>
                                </div>
                                <div class="shopping-right">
                                    <div class="text">
                                        <div class="text-t">{{ c.name }}</div>
                                        <div class="text-b">{{ c.description }}</div>
                                    </div>

                                        <div class="inform-left"><span class="numText">数量: </span> <input type="number" v-model="c.quantity"  class="num" min="1" :max="c.stock"></input></div>
                                        <div class="inform-right">{{ c.price }}</div>
                
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="cart-tip">
                    <span>备注：</span><br>
                    <span>您节省的金额包括了购物车所有单品优惠后的总优惠金额：</span><br>
                    <span>(1) 同配置产品在“推荐套餐”和“单机”选项下的价格之间的差额；以及</span><br>
                    <span>(2) 赠品的市场价值。</span><br>
                    <span>您可以返回结算页面前的对应产品的页面查看（1）或（2）的单品销售金额和套餐金额的比较信息。</span>
                </div>

            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { useCartStore } from '@/stores/shop';
import { useUserStore } from '@/stores/user';
import {onBeforeMount, onMounted, ref,  watch } from 'vue';
import { useRouter } from 'vue-router';
const router=useRouter()
const cartStore=useCartStore()
const userStore=useUserStore()
async function getCar() {
    await cartStore.fetchCart(userStore.userId)
}
let cart = ref([{
    cartId: 0, 
    name: "",
    description: "",
    quantity: 0,
    imgName: "",
     price: 0,
     stock: 0

}])
cart.value = cartStore.cartItems
let ishave = ref(false)
let totalPrice = ref(0)
let total = ref('')
let n = ref(0)

onBeforeMount(async () => {
    getCar()
    const stopwatch=watch(() => cartStore.cartItems, (newValue, oldValue) => {
        cart.value = newValue
        isShow()
        if (ishave.value) {
            totalPrice.value = 0
            n.value = 0
            for (let i = 0; i < cart.value.length; i++) {
                totalPrice.value += parseFloat((cart.value[i].price * cart.value[i].quantity).toFixed(2))
                n.value += cart.value[i].quantity
            }
            total.value = totalPrice.value.toFixed(2)
        }
        else    n.value=0
    }, { deep: true, immediate: true });
});
onMounted(() => {
    watch(cart, async(newValue, oldValue) => {
        cart.value=newValue
          
        if (ishave.value) {
        for (let i = 0; i < cart.value.length; i++) {
            if (cart.value == newValue) {
                await changeC(i)
            }
            else cart.value = newValue
            
        }
        }

    }, { deep: true})
});

async function changeC(i: number) {
    return new Promise<void>((resolve) => {
            const stopWatch = watch(
                () => cart.value[i]?.quantity,
                (newValue, oldValue) => {
                    if (!cart.value[i]) {
                        resolve();
                        return;
                    }
                    if (newValue !== oldValue) {
                        if (newValue <= 0) {
                            console.log(22);
                            alert("至少保留一件商品");
                            cart.value[i].quantity = 1;
                        } else if (newValue > cart.value[i].stock) {
                            alert(`该商品总库存为：${cart.value[i].stock},已超出库存`);
                            cart.value[i].quantity = cart.value[i].stock;
                        } else {
                            if (newValue && oldValue)
                                cartStore.changeCount(cart.value[i].cartId, newValue, userStore.userId);
                        }
                    }
                    if(!ishave.value){
                        stopWatch()
                    }
                },
                { immediate: true }
            );
            resolve();
           
    });
}


function isShow(){
    if (cart.value.length == 0) {
        ishave.value = false
    }
    else {
        ishave.value = true
    }
}

async function isdelete(shopId:number){
    const isDelete=window.confirm("是否要删除该商品")
    if(isDelete){
        await cartStore.deleteItem(shopId, userStore.userId,false)
        isShow()
    }
    
}
async function clearCar(){
    const isClear = window.confirm("是否要清空购物车")
    if(isClear){
        await cartStore.deleteItem(0,userStore.userId,true)
        isShow()
    }
}
function purchase(){
    console.log(JSON.stringify(cart.value));
    
    router.push({
        name: 'orders',
        query: {
            productInfo: JSON.stringify(cart.value)
        }
    })
}
</script>
<style scoped>
@import url(../css/bootstrap.min.css);
@import url(../css/shopCar.css);
@import url(../icomoon/style.css);
</style>