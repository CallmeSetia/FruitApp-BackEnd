import{a as S}from"./axios-c24e582b.js";import{S as T,a as V,A}from"./pagination-20aefc57.js";import{u as I,c as b,r as F,e as U}from"./index-8b7a88d8.js";import{l as C,a as z}from"./logo-dark-ebbb2157.js";import{_ as P,r as i,a as u,d as t,w as s,o as m,b as e,e as r,g as D,t as p,n as L,F as j,j as q,h as M,p as N,i as H}from"../js/app2.js";const Y={setup(){return{v$:I()}},components:{Swiper:T,SwiperSlide:V},data(){return{email:"",submitted:!1,error:null,tryingToReset:!1,isResetError:!1,Autoplay:A,logoDark:C,logoLight:z}},methods:{tryToReset(){if(this.submitted=!0,this.v$.$touch(),!this.v$.$invalid){if({}.VUE_APP_DEFAULT_AUTH==="firebase")return this.tryingToReset=!0,this.error=null,this.resetPassword({email:this.email}).then(o=>{this.tryingToReset=!1,this.isResetError=!1}).catch(o=>{this.tryingToReset=!1,this.error=o||"",this.isResetError=!0});({}).VUE_APP_DEFAULT_AUTH==="authapi"&&S.post("http://127.0.0.1:8000/api/password/create",{email:this.email}).then(o=>(this.isResetError=!0,this.error=o.data,o))}}},validations:{email:{required:b.withMessage("Email is required",F),email:b.withMessage("Please enter valid email",U)}},mounted(){document.body.classList.add("auth-body-bg")}},l=o=>(N("data-v-4760d9ca"),o=o(),H(),o),$={class:"auth-full-bg pt-lg-5 p-4"},K={class:"w-100"},O=l(()=>e("div",{class:"bg-overlay"},null,-1)),W={class:"d-flex h-100 flex-column"},G={class:"p-4 mt-auto"},J={class:"text-center"},Q=l(()=>e("h4",{class:"mb-3"},[e("i",{class:"bx bxs-quote-alt-left text-primary h1 align-middle me-3"}),e("span",{class:"text-primary"},"5k"),r("+ Satisfied clients ")],-1)),X={dir:"ltr",class:"owl-theme"},Z=l(()=>e("p",{class:"font-size-16 mb-4"},` " Fantastic theme with a ton of options. If you just want the HTML to integrate with your project, then this is the package. You can find the files in the 'dist' folder...no need to install git and all the other stuff the documentation talks about. " `,-1)),ee=l(()=>e("div",null,[e("h4",{class:"font-size-16 text-primary"}," Abs1981 "),e("p",{class:"font-size-14 mb-0"},"- Skote User")],-1)),te=l(()=>e("p",{class:"font-size-16 mb-4"},' " If Every Vendor on Envato are as supportive as Themesbrand, Development with be a nice experience. You guys are Wonderful. Keep us the good work. " ',-1)),se=l(()=>e("div",null,[e("h4",{class:"font-size-16 text-primary"}," nezerious "),e("p",{class:"font-size-14 mb-0"},"- Skote User")],-1)),oe={class:"auth-full-page-content p-md-5 p-4"},ae={class:"w-100"},ie={class:"d-flex flex-column h-100"},le={class:"mb-4 mb-md-5"},re=["src"],ne=["src"],de={class:"my-auto"},ce=l(()=>e("div",null,[e("h5",{class:"text-primary"},"Reset Password"),e("p",{class:"text-muted"},"Reset Password with Skote.")],-1)),ue={class:"mt-4"},me={class:"mb-3"},_e=l(()=>e("label",{for:"useremail"},"Email",-1)),he={key:0},pe={class:"mt-5 text-center"},fe={class:"mt-4 mt-md-5 text-center"},ve={class:"mb-0"},ge=l(()=>e("i",{class:"mdi mdi-heart text-danger"},null,-1));function be(o,d,we,_,a,w){const f=i("swiper-slide"),y=i("swiper"),c=i("BCol"),h=i("BRow"),v=i("router-link"),g=i("BAlert"),x=i("BFormInput"),k=i("BButton"),B=i("BForm"),E=i("BContainer");return m(),u("div",null,[t(E,{fluid:"",class:"p-0"},{default:s(()=>[t(h,{class:"g-0"},{default:s(()=>[t(c,{xl:"9"},{default:s(()=>[e("div",$,[e("div",K,[O,e("div",W,[e("div",G,[t(h,{class:"justify-content-center"},{default:s(()=>[t(c,{lg:"7"},{default:s(()=>[e("div",J,[Q,e("div",X,[t(y,{class:"mySwiper",loop:!0,modules:[a.Autoplay],"space-between":20,autoplay:{delay:2500,disableOnInteraction:!1}},{default:s(()=>[t(f,null,{default:s(()=>[Z,ee]),_:1}),t(f,null,{default:s(()=>[te,se]),_:1})]),_:1},8,["modules"])])])]),_:1})]),_:1})])])])])]),_:1}),t(c,{xl:"3"},{default:s(()=>[e("div",oe,[e("div",ae,[e("div",ie,[e("div",le,[t(v,{to:"/",class:"d-block auth-logo"},{default:s(()=>[e("img",{src:a.logoDark,alt:"",height:"18",class:"auth-logo-dark"},null,8,re),e("img",{src:a.logoLight,alt:"",height:"18",class:"auth-logo-light"},null,8,ne)]),_:1})]),e("div",de,[ce,e("div",ue,[t(g,{"model-value":!0,variant:"success",class:"text-center mb-4"},{default:s(()=>[r(" Enter your Email and instructions will be sent to you! ")]),_:1}),t(B,{onSubmit:D(w.tryToReset,["prevent"])},{default:s(()=>[t(g,{modelValue:a.isResetError,"onUpdate:modelValue":d[0]||(d[0]=n=>a.isResetError=n),class:"mb-4",variant:"danger",dismissible:""},{default:s(()=>[r(p(a.error),1)]),_:1},8,["modelValue"]),e("div",me,[_e,t(x,{modelValue:a.email,"onUpdate:modelValue":d[1]||(d[1]=n=>a.email=n),id:"useremail",placeholder:"Enter email",class:L({"is-invalid":a.submitted&&_.v$.email.$error,"is-valid":a.submitted&&!_.v$.email.$error})},null,8,["modelValue","class"]),(m(!0),u(j,null,q(_.v$.email.$errors,(n,R)=>(m(),u("div",{key:R,class:"invalid-feedback"},[n.$message?(m(),u("span",he,p(n.$message),1)):M("",!0)]))),128))]),t(h,{class:"mb-0"},{default:s(()=>[t(c,{cols:"12",class:"text-end"},{default:s(()=>[t(k,{variant:"primary",class:"w-md waves-effect waves-light",type:"submit"},{default:s(()=>[r(" Reset ")]),_:1})]),_:1})]),_:1})]),_:1},8,["onSubmit"]),e("div",pe,[e("p",null,[r(" Remember It ? "),t(v,{to:"/auth/login-2",class:"fw-medium text-primary"},{default:s(()=>[r(" Sign In here")]),_:1})])])])]),e("div",fe,[e("p",ve,[r(" © "+p(new Date().getFullYear())+" Skote. Crafted with ",1),ge,r(" by Themesbrand ")])])])])])]),_:1})]),_:1})]),_:1})])}const Re=P(Y,[["render",be],["__scopeId","data-v-4760d9ca"]]);export{Re as default};