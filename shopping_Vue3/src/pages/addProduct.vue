<template>
    <header class="header">
        <h1>发布物品</h1>
    </header>

    <main class="form-container">
        <form id="post-form" @submit.prevent="submitProduct">
            <!-- 标题 -->
            <div class="form-group">
                <label for="item-title">标题 <span class="required">*</span></label>
                <input type="text" id="item-title" name="title" placeholder="请输入物品标题" required v-model="form.pName">
            </div>

            <!-- 描述 -->
            <div class="form-group">
                <label for="item-description">描述 <span class="required">*</span></label>
                <textarea id="item-description" name="description" placeholder="请输入物品描述" rows="4" required
                    v-model="form.pDescirp"></textarea>
            </div>

            <!-- 图片上传 -->
            <div class="form-group">
                <label for="item-images">上传图片 <span class="required">*</span></label>
                <input type="file" id="item-images" name="images" accept="image/*" multiple required @change="changePic"
                    hidden>
                <label for="item-images" class="upload-btn">选择文件</label>
                <div v-for="(image, index) in form.pImage" :key="index" class="image-container">
                    <img :src="getImageURL(image)" alt="Product Image" class="product-image" />
                    <button @click="removePic(index)">x</button>
                </div>
                <small>支持拖拽上传，最多上传5张图片</small>
            </div>

            <!-- 分类选择 -->
            <div class="form-group">
                <label for="item-category">分类 <span class="required">*</span></label>
                <select id="item-category" name="category" required v-model="form.pClass">
                    <option value="" disabled selected>请选择分类</option>
                    <option value="电子产品">电子产品</option>
                    <option value="服饰">服饰</option>
                    <option value="家具家电">家具家电</option>
                    <option value="车辆">车辆</option>
                    <option value="五金工具">五金工具</option>
                    <option value="环保商品">环保商品</option>
                    <option value="其他">其他</option>
                </select>
            </div>

            <!-- 价格 -->
            <div class="form-group">
                <label for="item-price">价格 (¥) <span class="required">*</span></label>
                <input type="number" id="item-price" name="price" placeholder="请输入价格" min="0" step="0.01" required
                    v-model="form.pPrice">
            </div>
            <div class="form-group">
                <label for="item-stock">库存 (个) <span class="required">*</span></label>
                <input type="number" id="item-stock" name="stock" placeholder="请输入价格" min="0" step="1" required
                    v-model="form.pStock">
            </div>

            <!-- 按钮 -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">发布</button>
                <button type="reset" class="btn btn-secondary">重置</button>
            </div>
        </form>
    </main>
</template>
<script lang="ts" setup>

import { reactive } from 'vue';
import axios from 'axios';
import { useUserStore } from '@/stores/user';
const userStore=useUserStore()
const form = reactive({
    userId:0,
    pName: "",
    pDescirp: "",
    pPrice: 0,
    pClass: "",
    pStock:0,
    pImage: [] as File[], // 存储上传的文件
});
const MAX_IMAGES = 5;
async function submitProduct() {
    if (!form.pName || !form.pDescirp || form.pImage.length <= 0 || form.pStock<= 0 || !form.pClass || form.pPrice<=0) {
        alert("请合法填写所有字段，并至少上传一张图片！");
        return;
    }
    const formData = new FormData();
    formData.append("pName", form.pName);
    formData.append("pDescrip", form.pDescirp);
    formData.append("pPrice", form.pPrice.toString());
    formData.append("pClass", form.pClass);
    formData.append('userId', userStore.userId)
    formData.append('pStock',form.pStock.toString())
    console.log(formData);

    // 添加图片文件
    form.pImage.forEach((file) => {
        formData.append(`pImage[]`, file); // 多张图片
    });

    try {
        const response = await axios.post("http://localhost/project_PHP/add.php", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        if (response.data.success) {
            alert("商品发布成功！");
            // 清空表单
            form.userId = 0
            form.pName = ""
            form.pDescirp = ""
            form.pPrice = 0
            form.pStock=0
            form.pClass = ""
            form.pImage = []
        } else {
            alert(`商品发布失败：${response.data.message}`);
        }
    } catch (error) {
        console.error("提交失败", error);
        alert("提交失败，请稍后重试！");
    }
}
function changePic(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        if (form.pImage.length + target.files.length <= MAX_IMAGES) {
            form.pImage.push(...Array.from(target.files));  // 将新图片添加到form.pImage数组中
        } else {
            alert(`最多只能添加 ${MAX_IMAGES} 张图片`);
        }
    }
}
function getImageURL(file: File) {
    return URL.createObjectURL(file);
}
// 删除
function removePic(index: number) {
    form.pImage.splice(index, 1);
}

//特殊处理formData


</script>
<style scoped>
@import url(../css/add.css);
</style>