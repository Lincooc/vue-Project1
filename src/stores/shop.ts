import { defineStore } from 'pinia';
import axios from 'axios';

export const useCartStore = defineStore('usecart', {
  state: () => ({
    cartItems: [] as Array<{ cartId:number,name: string; description: string;quantity: number; imgName: string ;price:number ;stock:number}>,
  }),
  actions: {
    async fetchCart(userId: number) {
      const response = await axios.post('http://localhost/shopCar.php',{userId},
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
      const response=await axios.post('http://localhost/userCart.php', 
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

    async changeCount(shopId:number,quantity:number,userId:number){
      try{
          const response=await axios.post('http://localhost/changeCount.php', 
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
          const response=await axios.post('http://localhost/deleteItem.php', 
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
  },
});
