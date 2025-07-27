<template>
    <div class="register-container">
        <div class="register-form">
            <h2>修改个人信息</h2>

            <!-- 显示用户信息 -->
            <form @submit.prevent="changeInfo">
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" id="username" class="form-control" v-model="user.userName"
                        :readonly="!isEditable" />
                </div>

                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="email" id="email" class="form-control" v-model="user.email" :readonly="!isEditable" />

                </div>


                <div v-if="isEdiP" class="form-group">
                    <label for="password">原密码</label>
                    <input type="password" id="password" class="form-control" v-model="user.password" required />
                </div>

                <div v-if="isEdiP" class="form-group">
                    <label for="password">新密码</label>
                    <input type="password" id="password" class="form-control" v-model="user.Newpassword"
                        v-if="isEditable" :required="isRequire" />
                </div>

                <div v-if="isEdiP" class="form-group">
                    <label for="confirmPassword">确认密码</label>
                    <input type="password" id="confirmPassword" class="form-control" v-model="user.confirmPassword"
                        v-if="isEditable" :required="isRequire" />
                </div>
                <button type="button" @click="toggleEdit()" class="btn-hover typrobtn mt-2 mb-3">{{ text1 }}</button>
                <button type="button" v-if="isEditable" @click="editPassword()" class="btn-hover typrobtn mt-2 mb-3">{{
                    text2 }}</button>
                <button type="submit" v-if="isEditable" class="btn-hover typrobtn mt-2 mb-3">提交修改</button>
                <a href="javascript:;" @click="islogout">退出登录</a>
            </form>
        </div>

    </div>
</template>

<script lang="ts" setup>
import router from '@/router/router';
import { computed, ref } from 'vue';
import { useUserStore } from '@/stores/user';
import axios from 'axios';
const userStore=useUserStore()
const text1 = ref("修改个人信息")
const text2 = ref("修改密码")

const user = ref({
    userId:userStore.userId,
    userName: userStore.userName,
    email: userStore.email,
    password: '',
    Newpassword:'',
    confirmPassword: ''
});

const isEditable = ref(false);
const isEdiP = ref(false);
let isRequire=computed(()=>{
    if(user.value.Newpassword||user.value.confirmPassword)  return true
    else    return false
})
const toggleEdit = () => {
        isEditable.value = !isEditable.value;
        if (isEditable.value==true){
            text1.value="取消修改"
        }
        else{
            text1.value = "修改个人信息"
            user.value.userName = userStore.userName
            user.value.email = userStore.email
        }
}
const editPassword = () => {
    isEdiP.value = !isEdiP.value;
    if(isEdiP.value){
        text2.value="取消密码修改"
    }
    else{
        text2.value = "修改密码"
        user.value.password = ''
        user.value.Newpassword = ''
        user.value.confirmPassword = ''
    }
}
async function changeInfo() {
    if(isEdiP.value){
        if (user.value.Newpassword !== user.value.confirmPassword) {
            alert('密码和确认密码不一致');
            return;
        }
    }
    const result = await userStore.change(user.value)
    alert(result.message);
    if (result.success){
        window.location.reload();
        router.push('/login')
    }
    
}

function islogout(){
    let isl=window.confirm("是否要退出账号")
    if(isl){
        userStore.logout()
    }
}
</script>

<style scoped>
/* 你可以根据需要自定义样式 */
@import url("../css/bootstrap.min.css");
@import url("../css/log.css");
@import url("../css/signUp.css");
/* .profile-form {
    max-width: 400px;
    margin: 0 auto;
}

form div {
    margin-bottom: 1rem;
}

input {
    width: 100%;
    padding: 0.5rem;
    margin-top: 0.5rem;
}

button {
    padding: 0.7rem 1.5rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
} */
</style>
