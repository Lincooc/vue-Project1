import { defineStore } from 'pinia';
import axios from 'axios';
import router from '@/router/router';

export const useUserStore = defineStore('useUser', {
  state: () => (JSON.parse(localStorage.getItem('user') || 'null') || {
                userId:0,
                userName: '',
                email: '',
                isLoggedIn: false,
                cartItems: [] as Array<{ cartId: number; name: string; description: string; imgName: string; quantity: number }>,
            }),
            
  actions: {
    async register(userName: string, email: string, password: string) {
      try {
        const response = await axios.post('http://localhost/project_PHP/register.php', {
          userName,
          email,
          password,
        },{
    headers: {
        'Content-Type': 'application/json',
    },});

        if (response.data.success) {
          return { success: true, message: response.data.message }
        } else {
          return { success: false, message: response.data.message }
        }
      } catch (error) {
        console.error('注册错误', error);
        return { success: false, message: '注册错误，请稍后重试' }
      }
    },

    async login(email:string,password:string){
      try{
        const logUser=JSON.parse(localStorage.getItem('user')||'null')
        if(logUser!=null&&email == logUser.email && password == logUser.password){
          this.isLoggedIn=true
        }
        else{
          const response=await axios.post('http://localhost/project_PHP/log.php',{email,password})
          if(response.data.success){
            this.email=email
            this.userName=response.data.userInfo.userName
            this.isLoggedIn=true
            this.userId=response.data.userInfo.userId
            let logUser = {
              userId:this.userId,
              email: this.email,
              userName: this.userName,
              isLoggedIn: this.isLoggedIn
            }
            localStorage.setItem('user',JSON.stringify(logUser))
            return { success: true, message: response.data.message }
          }
          else{
            return { success: false, message: response.data.message }
          }
        }
        
      }catch (error) {
        console.error('登录错误', error);
        return { success: false, message: '登录错误，请稍后重试' }
      }
    },
    async change(user:object) {
      
    try {
        const response = await axios.post('http://localhost/project_PHP/changeInfo.php',user,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            });
        if (response.data.success) {
          console.log(response.data.message);
          
           const { userName, email } = user as { userName?: string, email?: string };
            this.userName=userName
            this.email=email
            let userInfo = JSON.parse(localStorage.getItem('user')||'null');
            userInfo.email = this.email;
            userInfo.userName = this.userName;
            localStorage.setItem('user', JSON.stringify(userInfo));
            
            return { success: true, message: "修改信息成功" }
        }
        return { success: false, message: response.data.message }

    } catch (error) {
        console.error('信息修改错误', error);
    }
  },
  logout(){
    localStorage.removeItem('user')
    this.isLoggedIn=false
    router.push('/login')
  }
  },


});
