<template>
    <div class="register-container">
        <div class="register-form">
            <h2>注册</h2>
            <form @submit.prevent="handleRegister">
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" id="username" required v-model="userName">
                </div>
                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="email" class="form-control" id="email" required v-model="email">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" id="password" required v-model="password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">确定密码</label>
                    <input type="password" class="form-control" id="confirm-password" required>
                </div>
                <button class="btn-hover typrobtn mt-2 mb-3">
                    <div class="progress-bar"></div>
                    <span>提交</span>
                </button>
                <RouterLink to="/login">已有账户,直接登录</RouterLink>
            </form>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { computed, ref } from 'vue';
import { useUserStore } from '@/stores/user';
import router from '@/router/router';
const userStore = useUserStore()
const userName = ref('')
const email = ref('')
const password = ref('')
const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{10,}$/;
const isPasswordValid = computed(() => passwordPattern.test(password.value));

const handleRegister = async () => {
    if (userName.value && email.value && password.value) {
        if(isPasswordValid.value){
            const result = await userStore.register(userName.value, email.value, password.value)
            alert(result.message);
            if (result.success)
                router.push('/login')
        }
        else{
            alert("密码至少长度为10并且包含数字和字母")
        }

    }
    else alert('请填写所有必填项')

};

</script>
<style scoped>
@import url("../css/bootstrap.min.css");
@import url("../css/signUp.css");
</style>
