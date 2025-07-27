<template>
    <div class="form-container">
        <h2 class="form-title">添加收货地址</h2>
        <form method="post">
            <!-- 收货人姓名 -->
            <div class="form-group">
                <label for="name">收货人姓名</label>
                <input type="text" v-model="address.name" id="name" name="name" placeholder="请输入收货人姓名" required>
            </div>

            <!-- 收货人电话 -->
            <div class="form-group">
                <label for="phone">收货人电话</label>
                <input type="tel" v-model="address.phone" id="phone" name="phone" placeholder="请输入收货人电话" required>
            </div>

            <!-- 省市区选择 -->
            <div class="form-group">
                <label for="region">省市区</label>
                <div class="region-group">
                    <select id="province" name="province" required v-model="address.province">
                        <option value="">请选择省</option>
                        <option value="北京市">北京市</option>
                        <option value="上海市">上海市</option>
                        <option value="广东省">广东省</option>
                    </select>
                    <select id="city" name="city" required v-model="address.city">
                        <option value="">请选择市</option>
                        <option value="北京市">北京市</option>
                        <option value="上海市">上海市</option>
                        <option value="深圳市">深圳市</option>
                    </select>
                    <select id="district" name="district" required v-model="address.district">
                        <option value="">请选择区</option>
                        <option value="海淀区">海淀区</option>
                        <option value="浦东新区">浦东新区</option>
                        <option value="南山区">南山区</option>
                    </select>
                </div>
            </div>

            <!-- 详细地址 -->
            <div class="form-group">
                <label for="detail">详细地址</label>
                <input type="text" v-model="address.detail" id="detail" name="detail" placeholder="请输入街道、门牌号等" required>
            </div>

            <!-- 默认地址 -->
            <div class="default-address">
                <input type="checkbox" v-model="address.isDefault" id="is_default" name="is_default">
                <label for="is_default">设为默认地址</label>
            </div>

            <!-- 提交按钮 -->
            <button type="button" class="submit-btn" @click="submitInfo()">保存地址</button>
        </form>
    </div>
</template>
<script lang="ts" setup>
import { ref } from 'vue';
import { useCartStore } from '@/stores/shop';
import { useUserStore } from '@/stores/user';
import router from '@/router/router';
const userStore=useUserStore()
const cartStore=useCartStore()
let address=ref(
    {
        addressId: 0,
        name: "",
        phone: "",
        province: "",
        city: "",
        district: "",
        detail: "",
        isDefault: false
    }
)
function submitInfo(){
    cartStore.addAddress(userStore.userId,address.value).then((result)=>{
        if(result){
            router.push('/address').then(() => {
                        location.reload()
                    })
        }
        
    })
    
    

}
</script>
<style scoped>
@import url(../css/addAddress.css);
</style>