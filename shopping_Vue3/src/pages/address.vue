<template>
    <div class="order-section">
        <h2 class="section-title">选择收货地址</h2>
        <div class="address-box" v-for="address in addressInfo">
            <input type="radio" v-model="selectedAddress"
                :value="address.addressId">
            <div class="address-info" @click="select(address.addressId)">
                <div class="address-name">
                    {{ address.name }} <span class="default-tag" v-if="address.isDefault">默认</span>
                </div>
                <div class="address-detail">
                    {{ address.province + address.city + address.district + address.detail }}
                </div>
                <div class="address-phone">{{ address.phone }}</div>
            </div>
            <button type="button" class="edit-btn">修改</button>
            <button type="button" class="del-btn" @click="del(address)">删除</button>
        </div>
        <button @click="add()" type="button">添加新地址</button>
        <button class="confirm" @click="confirm()" type="button">确定</button>
    </div>
</template>
<script lang="ts" setup>
import { onMounted, onUnmounted, ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useCartStore } from '@/stores/shop';
import { useUserStore } from '@/stores/user';
import { useRoute } from 'vue-router';
const route=useRoute()
const cartStore=useCartStore()
const userStore=useUserStore()
const router=useRouter()
interface info{
    addressId:number,
    city:string,
    detail:string,
    district:string,
    isDefault:boolean,
    name:string,
    phone:string,
    province:string
}
let addressInfo = ref<info[]>([]);
let selectedAddress = ref(0)
onMounted(() => {

    cartStore.address(userStore.userId).then((result) => {
        if (result) {
            console.log(result.index);
            addressInfo.value = result.message
            selectedAddress.value = result.index
        } else {
            console.log("无地址");
        }
    }).catch((error) => {
        console.error("获取地址信息失败:", error)
    });

   
    
})


watch(addressInfo,(newV,oldV)=>{
    addressInfo.value=newV
})
for(let i=0;i<addressInfo.value.length;i++){
    console.log(addressInfo.value[i]);
}
console.log(addressInfo.value);

function add(){
    router.push('/addAddress')
}
function del(address: info){
    let result=window.confirm("是否要删除？")
    if(result){
        cartStore.deleteAddress(address.addressId)
        location.reload()
    }
    
}
function confirm(){
    let x=route.query.list
    if(x){//对象
        console.log("对象");
        
        router.push({
            name: 'orders',
            query: {
                productInfo: x,
                index: selectedAddress.value
            }
        })
    }
    else{
        router.push({
            name: 'orders',
            query: {
                productInfo: JSON.stringify(cartStore.cartItems),
                index: selectedAddress.value
            }
        })
    }
    
}
function select(addressId:number){
    selectedAddress.value=addressId
}
</script>
<style scoped>
@import url(../css/orders.css);

</style>