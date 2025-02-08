<template>
    <div class="news-container">
        <h1>{{ title }}</h1>
        <p class="news-date">发布日期：{{ date }}</p>
        <div class="news-content" v-html="content" ></div>
    </div>
</template>

<script lang="ts" setup>
import { onMounted } from "vue";
import { useRoute } from "vue-router";
onMounted(() => {
    // 页面加载时滚动到顶部
    window.scrollTo(0, 0);
});
const route = useRoute(); // 获取路由对象
const title = route.query.title || "新闻标题"; // 接收标题参数
const content = route.query.content || "新闻正文内容"; // 接收正文内容参数
const date = route.query.date || "未知日期"; // 接收日期参数（可选）
</script>

<style scoped>
.news-container {
    max-width: 800px;
    margin: auto;
    margin-top: -33px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background-color: #e2f7d5;
}

.news-container h1 {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
}

.news-date {
    font-size: 14px;
    color: #888;
    margin-bottom: 20px;
}

.news-content {
    font-size: 16px;
    line-height: 1.8;
}
</style>
