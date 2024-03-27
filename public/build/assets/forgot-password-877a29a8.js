import{p as b}from"./profile-img-1e13af7a.js";import{l as v}from"./logo-9faa3827.js";import{a as w}from"./axios-c24e582b.js";import{_ as R,r as l,a as x,d as s,w as t,o as C,b as e,e as a,t as c,f as k,k as V,v as T}from"../js/app2.js";const E={data(){return{email:"",error:"",status:"",isResetError:!1,tryingToReset:!1,processing:!1,profileImg:b,logo:v}},mounted(){this.isResetError=!!this.error,this.tryingToReset=!!this.status},methods:{async forget(){this.processing=!0,await w.post("/api/forget-password",{email:this.email}).then(({data:r})=>{r.success==!0&&r.message=="success"?(this.status="Password reset link send in your email.",this.tryingToReset=!0):r.data==400&&(this.error=r.message,this.isResetError=!0)}).catch(({response:{data:r}})=>{console.log(r)}).finally(()=>{this.processing=!1})}}},P={class:"account-pages my-5 pt-5"},S={class:"bg-primary-subtle"},F=e("div",{class:"text-primary p-4"},[e("h5",{class:"text-primary"},"Reset Password"),e("p",null,"Re-Password with Skote.")],-1),I=["src"],D={class:"avatar-md profile-user-wid mb-4"},N={class:"avatar-title rounded-circle bg-light"},U=["src"],j={class:"p-2"},A={class:"mb-3"},M=e("label",{for:"useremail"},"Email",-1),O={class:"mt-5 text-center"},Y=e("i",{class:"mdi mdi-heart text-danger"},null,-1);function q(r,i,z,G,o,p){const d=l("BCol"),m=l("BRow"),u=l("router-link"),_=l("BAlert"),f=l("BButton"),g=l("BForm"),h=l("BCardBody"),B=l("BCard"),y=l("BContainer");return C(),x("div",P,[s(y,null,{default:t(()=>[s(m,{class:"justify-content-center"},{default:t(()=>[s(d,{md:"8",lg:"6",xl:"5"},{default:t(()=>[s(B,{"no-body":"",class:"overflow-hidden"},{default:t(()=>[e("div",S,[s(m,null,{default:t(()=>[s(d,{cols:"7"},{default:t(()=>[F]),_:1}),s(d,{cols:"5",class:"align-self-end"},{default:t(()=>[e("img",{src:o.profileImg,alt:"",class:"img-fluid"},null,8,I)]),_:1})]),_:1})]),s(h,{class:"pt-0"},{default:t(()=>[e("div",null,[s(u,{to:"/"},{default:t(()=>[e("div",D,[e("span",N,[e("img",{src:o.logo,alt:"",height:"34"},null,8,U)])])]),_:1})]),e("div",j,[s(_,{modelValue:o.isResetError,"onUpdate:modelValue":i[0]||(i[0]=n=>o.isResetError=n),class:"mb-4",variant:"danger",dismissible:""},{default:t(()=>[a(c(o.error),1)]),_:1},8,["modelValue"]),s(_,{modelValue:o.tryingToReset,"onUpdate:modelValue":i[1]||(i[1]=n=>o.tryingToReset=n),class:"mb-4",variant:"success",dismissible:""},{default:t(()=>[a(c(o.status),1)]),_:1},8,["modelValue"]),s(g,{action:"javascript:void(0)",method:"POST"},{default:t(()=>[k(r.$slots,"default"),e("div",A,[M,V(e("input",{type:"email",name:"email","onUpdate:modelValue":i[2]||(i[2]=n=>o.email=n),class:"form-control",id:"useremail",placeholder:"Enter email"},null,512),[[T,o.email]])]),s(m,{class:"form-group mb-0"},{default:t(()=>[s(d,{cols:"12",class:"text-end"},{default:t(()=>[s(f,{variant:"primary",type:"submit",disabled:o.processing,onClick:i[3]||(i[3]=n=>p.forget()),class:"btn-block"},{default:t(()=>[a(c(o.processing?"Please wait":"Forget Password"),1)]),_:1},8,["disabled"])]),_:1})]),_:1})]),_:3})])]),_:3})]),_:3}),e("div",O,[e("p",null,[a(" Remember It ? "),s(u,{to:"/login",class:"fw-medium text-primary"},{default:t(()=>[a("Sign In here")]),_:1})]),e("p",null,[a(" © "+c(new Date().getFullYear())+" Skote. Crafted with ",1),Y,a(" by Themesbrand ")])])]),_:3})]),_:3})]),_:3})])}const Q=R(E,[["render",q]]);export{Q as default};
