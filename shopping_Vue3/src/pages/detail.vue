<template>
    <div class="container my-5">
        <div class="row set">
            <!-- 图片区域 -->
            <div class="col-md-6">
                <div class="carousel slide" id="mycarousel" data-ride="carousel" data-interval="2000">
                    <div class="carousel-inner">
                        <div class="carousel-item" v-for="(img, index) in productInfo.imgName.split(',')"
                            :class="{ 'active' : index==0 }">

                            <img :src="'http://localhost/project_PHP/'+img" alt="">

                        </div>
                    </div>

                    <ol class="carousel-indicators">
                        <li data-target="#mycarousel" v-for="index in productInfo.imgName.split(',').length" :class="{ 'active': index == 0 }
                    " :data-slide-to="index-1"></li>
                    </ol>
                    <div class="inner">
                        <a href="#mycarousel" class="carousel-control-prev" data-slide="prev" role="button">
                            <span class="carousel-control-prev-icon" style="filter: invert(100%);"></span>
                        </a>
                        <a href="#mycarousel" class="carousel-control-next" data-slide="next" role="button">
                            <span class="carousel-control-next-icon" style="filter: invert(100%);"></span>
                        </a>

                    </div>
                </div>
            </div>

            <!-- 详情区域 -->
            <div class="col-md-6">
                <h1 class="mb-3">{{ productInfo.name }}</h1>
                <p class="price">{{ productInfo.price }}</p>
                <p>商品描述：{{ productInfo.description }}</p>
                <p :style="'color:grey'">库存：{{ productInfo.stock }}</p>
                <div class="d-flex align-items-center mb-3">
                    <label for="quantity" class="mr-3">数量:</label>
                    <input type="number" id="quantity" class="form-control w-25" min="1" max="{{ productInfo.stock }}"
                        value="1" v-model="quantity">
                </div>
                <button class="btn btn-primary addCar" @click="addCart">加入购物车</button>
                <button class="btn btn-primary btn-lg pur ml-5" @click="purchase">立即购买</button>
                <div><button class="btn btn-outline-secondary ml-2 back" @click="back">返回</button></div>
            </div>
        </div>

        <!-- 其他信息 -->

        <div class="guarantees mt-4">
            <div class="guarantee-item">
                <i class="fas fa-truck"></i>
                <span>免运费</span>
            </div>
            <div class="guarantee-item">
                <i class="fas fa-undo-alt"></i>
                <span>30 天无理由退货</span>
            </div>
            <div class="guarantee-item">
                <i class="fas fa-shield-alt"></i>
                <span>正品保障</span>
            </div>
            <div class="guarantee-item">
                <i class="fas fa-certificate"></i>
                <span>质量检测认证</span>
            </div>
            <div class="guarantee-item">
                <i class="fas fa-lock"></i>
                <span>安全支付保障</span>
            </div>
        </div>
        <div class="user-reviews mt-4">
            <h3>用户评价</h3>
            <div class="review-item">
                <p class="reviewer-name">用户 A</p>
                <p class="review-text">这款商品真的很不错，质量很好，使用起来也很方便，非常满意！</p>
                <p class="review-date">2024-11-01</p>
            </div>
            <div class="review-item">
                <p class="reviewer-name">用户 B</p>
                <p class="review-text">外观设计很漂亮，功能也符合我的需求，就是物流稍微有点慢。</p>
                <p class="review-date">2024-11-15</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h3>商家信息</h3>
                <p>商家：{{ shopId }}</p>
                <h3>商品详情</h3>
                <p>材质：无</p>
                <p>品牌：无</p>

            </div>
        </div>

    </div>
</template>
<script lang="ts" setup>
import { useRoute } from 'vue-router';
import { onMounted, ref, watch } from 'vue';

import axios from 'axios';
import { color } from 'chart.js/helpers';
const route=useRoute()
let productInfo = ref(
    {
        name: '',
        price: 0,
        imgName: '',
        description:'',
        stock:0,
        quantity:1
    }
)
let shopId=ref(0)
let quantity=ref(1)
async function showProduct(){
    
    try {
        let proId=ref(route.params.proId)
        const response = await axios.post('http://localhost/project_PHP/detail.php',
            { proId: proId.value },
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            });
        if (response.data.success) {
            productInfo.value = response.data.product
            shopId.value=response.data.shopId.userName
            
        }
        else alert(response.data.message);

    } catch (error) {
        console.error('获取分类失败', error);
    }
}
onMounted(showProduct)
watch(() => route.params.proId, showProduct);

import { useCartStore } from '@/stores/shop';
import { useUserStore } from '@/stores/user';
import router from '@/router/router';
const carStore=useCartStore()
const userStore=useUserStore()
let proId = Number(route.params.proId)
onMounted(() => {
    // 页面加载时滚动到顶部
    window.scrollTo(0, 0);
});
async function addCart(){
    if(userStore.isLoggedIn){
        if (quantity.value <= 0) alert("商品数量至少为1")
        else if (quantity.value > productInfo.value.stock) alert("库存不足")
        else if (quantity.value <= productInfo.value.stock)
            await carStore.addToCart(userStore.userId, proId, quantity.value)
    }else{
        alert("请先登录后再添加购物车")
        router.push('/login')
    }
    
}

function purchase(){
    if (userStore.isLoggedIn) {
        if(quantity.value<=0)   alert("商品数量至少为1")
        else if (quantity.value > productInfo.value.stock)  alert("库存不足")
        else if (quantity.value <= productInfo.value.stock){
            productInfo.value.quantity=quantity.value
            router.push({
                name:'orders',
                query:{
                    productInfo:JSON.stringify(productInfo.value)
                }
            })
        }
    } else {
        alert("请先登录后再添加购物车")
        router.push('/login')
    }
}
function back(){
    router.back()
}
</script>

<style scoped>
@import url(../css/bootstrap.min.css);
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
.carousel-item img {
    max-height: 400px;
    object-fit: contain;
    height: 400px;
    margin: auto;
    display: block;
}

.carousel-indicators li {
    background-color: #000;
}

.price {
    font-size: 1.5rem;
    color: #d9534f;
    font-weight: bold;
}
.pur{

    background-color: #f75252;
    border: 0;
}
.back{
    margin-top: 30px;
    margin-left: 30px;
}
/* 新增 */



.guarantees {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.guarantee-item {
    display: flex;
    align-items: center;
}

.guarantee-item i {
    margin-right: 8px;
    color: #007bff;
    font-size: 1.2rem;
}

/* 用户评价区域样式 */
.user-reviews {
    margin-top: 20px;
}

.review-item {
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.reviewer-name {
    font-weight: bold;
}

.review-date {
    color: #999;
    font-size: 0.8rem;
}

/* 商品推荐区域样式 */
.product-recommendations {
    margin-top: 20px;
}

.recommendation-item {
    text-align: center;
    margin-bottom: 20px;
}

.recommendation-item img {
    max-width: 100px;
    max-height: 100px;
    object-fit: cover;
    border-radius: 4px;
    margin-bottom: 5px;
}

section {
    margin-top: 30px;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}
.set{
        background-color: white;
        padding: 10px;
}
</style>