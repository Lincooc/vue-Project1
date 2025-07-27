import { defineStore } from 'pinia';
import axios from 'axios';
interface info{
    addressId:number,
    city:string,
    detail:string,
    district:string,
    isDefault:boolean,
    name:string,
    phone:string,
    province:string
}
export const useCartStore = defineStore('usecart', {
  state: () => ({
    cartItems: [] as Array<{ cartId:number,name: string; description: string;quantity: number; imgName: string ;price:number ;stock:number}>,
    addressInfo:[] as Array<info>,
    defalutNum:(JSON.parse(sessionStorage.getItem('defaultId')||'null'))||-1,//地址
  }),
  actions: {
    async fetchCart(userId: number) {
      const response = await axios.post('http://localhost/project_PHP/shopCar.php',{userId},
        {
          headers: {
                    "Content-Type": "multipart/form-data",
                },
        }
      );
      if(response.data.success){
        this.cartItems = response.data.cart;      
      }
      else{
        alert(response.data.message)
      }
    },
    async addToCart(userId: number, proId: number, quantity: number = 1) {
      const response=await axios.post('http://localhost/project_PHP/userCart.php', 
        { userId, proId, quantity },
        {
          headers: {
                    "Content-Type": "multipart/form-data",
                },
        }
      );
      if(response.data.success){
        alert("加入购物车成功")
      }
      else{
        alert(response.data.message)
      }
      this.fetchCart(userId);
    },

    async purchase(){
      
    },

    async changeCount(shopId:number,quantity:number,userId:number){
      try{
          const response=await axios.post('http://localhost/project_PHP/changeCount.php', 
              { shopId, quantity},
              {
                headers: {
                          "Content-Type": "multipart/form-data",
                      },
              }
            );
            if(!response.data.success){
              alert(response.data.message)
            }
            this.fetchCart(userId);
      }catch{
        alert("出错了，请稍后再试")
      }
      
    },

    async deleteItem(shopId:number,userId:number,all:boolean){
      try{
          const response=await axios.post('http://localhost/project_PHP/deleteItem.php', 
              { shopId,all},
              {
                headers: {
                          "Content-Type": "multipart/form-data",
                      },
              }
            );
            if(!response.data.success){
              alert(response.data.message)
              return {success:false}
            }
            else{
              this.fetchCart(userId);
              alert(response.data.message)
              return {success:true}
              
            }
            
      }catch{
        alert("出错了，请稍后再试")
      }
      
    },

    async addAddress(userId:number,address:object){
      try{
          const response=await axios.post('http://localhost/project_PHP/addAddress.php', 
            {userId,address},
              {
                headers: {
                          "Content-Type": "multipart/form-data",
                      },
                withCredentials: true
              }
            );
            if(!response.data.success){
              alert(response.data.message)
              return {success:false,message:response.data.message}
            }
            else{
              return {success:true,message:response.data.message}
              
            }
            
      }catch{
        alert("出错了，请稍后再试")
      }
      
    },
      async address(userId:number){
      try{
          const response=await axios.post('http://localhost/project_PHP/address.php', 
            {userId},
              {
                headers: {
                          "Content-Type": "multipart/form-data",
                      },
                  withCredentials: true
              }
            );
            if(!response.data.success){
              alert(response.data.message)
              return {success:false,message:response.data.message,index:response.data.index}
            }
            else{
              console.log(response.data.message);
              console.log(response.data.index);
              
              this.addressInfo=response.data.message
              this.defalutNum=response.data.index
              sessionStorage.setItem('defaultId',JSON.stringify(response.data.index))
              return {success:true,message:response.data.message,index:response.data.index}
            }
            
      }catch{
        alert("出错了，请稍后再试")
      }
      
    },
    async deleteAddress(addressId:number){
      try{
          const response=await axios.post('http://localhost/project_PHP/deleteAddress.php', 
              {addressId},
              {
                headers: {
                          "Content-Type": "multipart/form-data",
                      },
                withCredentials: true
              }
            );
            if(!response.data.success){
              alert(response.data.message)
              return {success:false}
            }
            else{
              alert(response.data.message)
              return {success:true}
              
            }
            
      }catch{
        alert("出错了，请稍后再试")
      }
      
    },
    async orderAddress(addressId:number){
      try{
          const response=await axios.post('http://localhost/project_PHP/orders.php', 
            {addressId},
              {
                headers: {
                          "Content-Type": "multipart/form-data",
                      },
              }
            );
            if(!response.data.success){

              return {success:false,message:response.data.message}
            }
            else{
              console.log(response.data.message);
            
              return {success:true,message:response.data.message,index:response.data.index}
            }
            
      }catch{
        alert("出错了，请稍后再试")
      }
      
    },
     async isorderAddress(userId:number){
      try{
          const response=await axios.post('http://localhost/project_PHP/ishaveAddress.php', 
            {userId},
              {
                headers: {
                          "Content-Type": "multipart/form-data",
                      },
                 withCredentials: true
              }
            );
             console.log(response.data.message);
            if(response.data.success){
              if(response.data.ishaveAddress){//表不为空
                this.defalutNum=response.data.index
                return {success:true,message:response.data.message}
              }
              else{
                return {success:true,message:null}
              }
            }
            else{
              alert(response.data.message)
              return {success:false}
            }
            
      }catch{
        alert("出错了，请稍后再试")
      }
      
    },
  },
});
