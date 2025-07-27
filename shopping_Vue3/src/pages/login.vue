<template>
    <div class="register-container">
        <div class="register-form">
            <h2>登录</h2>
            <form @submit.prevent="handleLogin">
                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="email" class="form-control" id="email" required v-model="email">
                </div>

                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" id="password" required v-model="password">
                </div>
                <button class="btn-hover typrobtn mt-2 mb-3">
                    <div class="progress-bar"></div>
                    <span>提交</span>
                </button>
                <RouterLink to="/register">没有账户，创建一个</RouterLink>
            </form>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { ref } from 'vue';
import { useUserStore } from '@/stores/user';
import router from '@/router/router';
const userStore = useUserStore()
const email = ref('')
const password = ref('')
// 注册处理函数
const logUser = JSON.parse(localStorage.getItem('user') || 'null')
if (logUser != null && email == logUser.email && password == logUser.password) {
    userStore.isLoggedIn = true
}
const handleLogin = async () => {
    if (email.value && password.value) {
        const result = await userStore.login(email.value, password.value)
        alert(result.message);
        if(result.success){
            router.push('/index')
        }
    }
    else alert('请填写所有必填项')

};
</script>
<style scoped>
@import url("../css/bootstrap.min.css");
@import url("../css/log.css");
@import url("../css/signUp.css");
</style>