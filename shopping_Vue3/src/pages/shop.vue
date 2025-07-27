<template>

    <!-- 商品展示区 -->
    <section class="product-section">
        <RouterLink class="product-card" v-for="item in products" :to="
        {
            name:'detail',
            params:{
                proId:item.proId
            }

        }
        ">
            <img :src="'http://localhost/project_PHP/' + item.imgName.split(',')[0]" alt="商品图片">
            <div class="product-info">
                <h3>{{item.name}}</h3>
                <p class="price">{{ item.price }}</p>
            </div>
        </RouterLink>

    </section>

    <!-- 底部 -->
    <footer>
        <p>&copy; 2024 二手平台 | 版权所有</p>
    </footer>
</template>
<script lang="ts" setup>
import { ref, onMounted, watch } from 'vue';
import { RouterLink, useRoute } from 'vue-router';
import axios from 'axios';
const route=useRoute()


let products = ref([
    {
        proId:0,
        name:'',
        price:0,
        imgName:'',
    }
])
const loading = ref(true);
async function postClass() {
    try {
        let classProduct = ref(route.params.classProduct || 'all')
        const response = await axios.post('http://localhost/project_PHP/look.php', 
        {className:classProduct.value},
            { headers: {
                    "Content-Type": "multipart/form-data",
                },
            });
        if (response.data.success) {
            products.value = response.data.products;

            
        }
        else   alert(response.data.message);
        
    } catch (error) {
        console.error('获取分类失败', error);
    }
}
onMounted(postClass)
watch(() => route.params.classProduct, postClass);
</script>

<style>
@import url(../css/shop.css);
</style>