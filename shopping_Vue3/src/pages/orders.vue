<template>
    <div class="container">
        <!-- 地址信息 -->
        <div class="order-section">
            <a href="#" class="section-title" @click="jump()">选择收货地址 ></a>
            <div class="address-box" v-if="ishaveAddress">
                <input type="radio" name="address" checked>
                <div class="address-info">
                    <div class="address-name">
                        {{ address.name }} <span class="default-tag" v-if="address.isDefault">默认</span>
                    </div>
                    <div class="address-detail">
                        {{ address.province + address.city + address.district + address.detail }}
                    </div>
                    <div class="address-phone">{{ address.phone }}</div>
                </div>
                <button class="edit-btn">修改</button>
            </div>
        </div>

        <!-- 商品信息 -->
        <div class="order-section">
            <h2 class="section-title">订单商品</h2>
            <div class="product-list">
                <!-- 商品项 -->
                <div v-if="ishave" class="product-item" v-for="product in productInfo">
                    <img :src="'http://localhost/project_PHP/' + product.imgName.split(',')[0]" alt="商品" class="product-img">
                    <div class="product-info">
                        <div class="product-title">{{ product.name }}</div>
                        <div class="product-spec">{{ product.description }}</div>
                    </div>
                    <div class="product-price">
                        <div>{{ product.price }}</div>
                        <div class="product-quantity"><span class="numText">数量: </span> <input type="number"
                                v-model="product.quantity" class="num" min="1" :max="product.stock"></input></div>
                    </div>
                </div>
                <p v-else>出错了，请加载重试</p>
                <!-- 可以添加更多商品项 -->
            </div>
        </div>

        <!-- 支付方式 -->
        <div class="order-section">
            <h2 class="section-title">选择支付方式</h2>
            <div class="payment-methods">
                <label class="payment-item" :class="{ active: selectedPayment === 'alipay' }">
                    <input type="radio" name="payment" value="alipay" v-model="selectedPayment">
                    <img src="../image/alipay.png" class="payment-icon" alt="支付宝">
                    支付宝支付
                </label>
                <label class="payment-item" :class="{ active: selectedPayment === 'wechat' }">
                    <input type="radio" name="payment" value="wechat" v-model="selectedPayment">
                    <img src="../image/wechat-logo.png" class="payment-icon" alt="微信">
                    微信支付
                </label>
            </div>
        </div>

        <!-- 价格汇总 -->
        <div class="order-section">
            <div class="price-summary">
                <div class="price-line">
                    商品总额：<span>{{ totalPrice }}</span>
                </div>
                <div class="price-line">
                    运费：<span>¥0.00</span>
                </div>
                <div class="price-line total-price">
                    实付款：<span>{{ totalPrice }}</span>
                </div>
            </div>
            <button class="submit-btn" @click="submitOrder">提交订单</button>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import { onMounted, ref, watch } from 'vue';
    import { useRoute } from 'vue-router';
    import { useRouter } from 'vue-router';
    import { useCartStore } from '@/stores/shop';
    import { useUserStore } from '@/stores/user';
    const userStore = useUserStore()
    const cartStore=useCartStore()
    const router=useRouter()
    const route=useRoute()
    const selectedPayment = ref<string>('alipay');
    const submitOrder = () => {
    if (selectedPayment.value === 'alipay') {
        window.location.href = 'https://www.alipay.com'; 
    } else if (selectedPayment.value === 'wechat') {
        window.location.href = 'https://pay.weixin.qq.com'; 
    }
    };
    interface products{
        proId: number,
        name:string,
        description:string,
        imgName:string,
        price:number,
        stock:number,
        quantity:number
    }
    let address = ref({
        addressId: 0,
        city: "",
        detail: "",
        district: "",
        isDefault: false,
        name: "",
        phone: "",
        province: ""
    });
    watch(address,(newV,oldV)=>{
        address.value=newV
    })

    let ishave=ref(false)
    let productInfo = ref<products[]>([])
    let product = ref<products>()
    let list = JSON.parse(route.query.productInfo as string)
    let shape=ref(0) //0是对象，1是数组
    if(Array.isArray(list)){
        productInfo.value = list
        shape.value=1
    } 
    else if(typeof list ==='object'){
        productInfo.value.push(list)
        product.value = list
    }    

    let totalPrice=ref(0)
    watch(productInfo, (newV, oldV) => {
        if (newV) ishave.value = true
    },{deep:true,immediate:true})
    for(let i=0;i<productInfo.value.length;i++){
        totalPrice.value+=productInfo.value[i].price*productInfo.value[i].quantity
        watch(()=>productInfo.value[i].quantity,(newValue,oldValue)=>{
            totalPrice.value+=(newValue-oldValue)*productInfo.value[i].price
        })
    }
    function jump(){
        if(shape.value){
            router.push('/address')
        }
        else{
            router.push({
                path: '/address',
                query:{
                    list: JSON.stringify(product.value)
                }
            })
        }
        
    }
    let addressId = ref(0)
    let ishaveAddress=ref(false)
    if(route.query.index){
        addressId.value = JSON.parse(route.query.index as string)
        ishaveAddress.value = true
        cartStore.orderAddress(addressId.value).then((result) => {
            address.value = result?.message
            if (address.value.isDefault == "0") address.value.isDefault = false
            else address.value.isDefault = true
        })
    }
    else{
        if (cartStore.defalutNum != -1) {//有默认
            addressId.value = cartStore.defalutNum
            ishaveAddress.value = true
            cartStore.orderAddress(addressId.value).then((result) => {
                address.value = result?.message
                if (address.value.isDefault == "0") address.value.isDefault = false
                else address.value.isDefault = true
            })
        }
       
        else{
            cartStore.isorderAddress(userStore.userId).then((result)=>{
                if(result?.message!=null){
                    ishaveAddress.value=true
                    address.value=result.message
                    if(address.value.isDefault=="0")    address.value.isDefault=false
                    else    address.value.isDefault=true
                    
                }
    
            })
        }
       
    }



    
    
    
</script>
<style scoped>
@import url(../css/orders.css);
</style>