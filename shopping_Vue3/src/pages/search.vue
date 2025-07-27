<template>
    <div>
        <!-- 搜索框 -->
        <div class="search-container">
            <input type="text" v-model="keyword" placeholder="请输入搜索关键词" @keyup.enter="search" class="search-input" />
            <button @click="search" class="search-btn">搜索</button>
        </div>

        <section class="product-section" v-if="results.length>0" v-show="keyword.trim()">
            <RouterLink class="product-card" v-for="item in results" :to="{
                    name: 'detail',
                    params: {
                        proId: item.proId
                    }

                }
                ">
                <img :src="'http://localhost/project_PHP/' + item.imgName.split(',')[0]" alt="商品图片">
                <div class="product-info">
                    <h3>{{ item.name }}</h3>
                    <p class="price">{{ item.price }}</p>
                </div>
            </RouterLink>

        </section>


        <div v-else-if="keyword && !loading">没有找到相关商品。</div>
        <div v-else-if="loading">正在搜索，请稍候...</div>
        <!-- 底部 -->
        <footer>
            <p>&copy; 2024 二手平台 | 版权所有</p>
        </footer>
    </div>
</template>

<script lang="ts" setup>
import { ref, watch } from "vue";
import axios from "axios";

const keyword = ref(""); // 搜索关键词
const results = ref([
    {
        proId: 0,
        name: '',
        price: 0,
        imgName: '',
    }
])
const loading = ref(false); // 是否正在加载

const search = async () => {
    if (!keyword.value.trim()) {
        alert("请输入关键词");
        return;
    }

    loading.value = true;
    try {
        const response = await axios.post("http://localhost/project_PHP/search.php", {
            keyword: keyword.value.trim(),
        },{
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        results.value = response.data.results;
        console.log(results.value);
        
    } catch (error) {
        console.error("搜索失败：", error);
        alert("搜索失败，请重试");
    } finally {
        loading.value = false;
    }
};

watch(()=>keyword.value,(newvlaue,oldvalue)=>{
    if (newvlaue.trim())
    search()
})
</script>

<style scoped>
.search-container {
    margin: 20px;
}

.search-input {
    padding: 10px;
    font-size: 16px;
    width: 300px;
}

.search-btn {
    padding: 10px 20px;
    margin-left: 10px;
    font-size: 16px;
    cursor: pointer;
}
@import url(../css/shop.css);
</style>
