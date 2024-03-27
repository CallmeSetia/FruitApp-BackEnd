import{p as C}from"./profile-img-1e13af7a.js";import{l as S}from"./logo-9faa3827.js";import{a as V}from"./axios-c24e582b.js";import{_ as E,r as n,a as F,d as t,w as s,o as A,b as e,e as l,t as m,f as I}from"../js/app2.js";const T={data(){return{auth:{username:"",password:""},profileImg:C,logo:S,processing:!1,authError:null,isAuthError:!1}},beforeCreate(){localStorage.getItem("user")&&this.$router.push("/")},computed:{$csrfToken(){return document.head.querySelector('meta[name="csrf-token"]').content}},methods:{async login(){this.processing=!0,this.auth._token=this.$csrfToken;try{const o=(await V.post("/api/login/admin",this.auth)).data;if(o.success){const _={login:!0,user_id:o.data.id,name:o.data.name,username:o.data.username,token:o.data.token};localStorage.setItem("user",JSON.stringify(_)),this.$router.push("/")}else this.authError=o.message||"An error occurred during login.",this.isAuthError=!0}catch(r){console.error("Login error:",r.response?r.response.data:r.message)}finally{this.processing=!1}}}},j={class:"account-pages my-5 pt-5"},U={class:"bg-primary-subtle"},L=e("div",{class:"text-primary p-4"},[e("h5",{class:"text-primary"},"Welcome Back !"),e("p",null,"Sign in to continue to Skote.")],-1),N=["src"],D={class:"avatar-md profile-user-wid mb-4"},P={class:"avatar-title rounded-circle bg-light"},R=["src"],G=["value"],O={class:"mt-3 d-grid"},q={class:"mt-4 text-center"},z=e("h5",{class:"font-size-14 mb-3"},"Sign in with",-1),J={class:"list-inline"},W={class:"list-inline-item"},Y=e("i",{class:"mdi mdi-facebook"},null,-1),H={class:"list-inline-item"},K=e("i",{class:"mdi mdi-twitter"},null,-1),M={class:"list-inline-item"},Q=e("i",{class:"mdi mdi-google"},null,-1),X={class:"mt-4 text-center"},Z=e("i",{class:"mdi mdi-lock mr-1"},null,-1),$={class:"mt-5 text-center"},ee=e("i",{class:"mdi mdi-heart text-danger"},null,-1);function te(r,o,_,se,a,p){const c=n("BCol"),h=n("BRow"),d=n("router-link"),b=n("BAlert"),f=n("BFormInput"),g=n("BFormGroup"),B=n("BFormCheckbox"),v=n("BButton"),u=n("BLink"),k=n("BForm"),w=n("BCardBody"),y=n("BCard"),x=n("BContainer");return A(),F("div",j,[t(x,null,{default:s(()=>[t(h,{class:"justify-content-center"},{default:s(()=>[t(c,{lg:"6",md:"8",xl:"5"},{default:s(()=>[t(y,{class:"overflow-hidden","no-body":""},{default:s(()=>[e("div",U,[t(h,null,{default:s(()=>[t(c,{cols:"7"},{default:s(()=>[L]),_:1}),t(c,{class:"align-self-end",cols:"5"},{default:s(()=>[e("img",{src:a.profileImg,alt:"",class:"img-fluid"},null,8,N)]),_:1})]),_:1})]),t(w,{class:"pt-0"},{default:s(()=>[e("div",null,[t(d,{to:"/"},{default:s(()=>[e("div",D,[e("span",P,[e("img",{src:a.logo,alt:"",height:"34"},null,8,R)])])]),_:1})]),t(b,{modelValue:a.isAuthError,"onUpdate:modelValue":o[0]||(o[0]=i=>a.isAuthError=i),class:"mt-3",dismissible:"",variant:"danger"},{default:s(()=>[l(m(a.authError),1)]),_:1},8,["modelValue"]),t(k,{action:"javascript:void(0)",class:"p-2",method:"POST"},{default:s(()=>[I(r.$slots,"default"),t(g,{id:"input-group-1",class:"mb-3",label:"Username","label-for":"input-1"},{default:s(()=>[t(f,{id:"input-1",modelValue:a.auth.username,"onUpdate:modelValue":o[1]||(o[1]=i=>a.auth.username=i),name:"username",placeholder:"Enter Username",type:"text"},null,8,["modelValue"])]),_:1}),t(g,{id:"input-group-2",class:"mb-3",label:"Password","label-for":"input-2"},{default:s(()=>[t(f,{id:"input-2",modelValue:a.auth.password,"onUpdate:modelValue":o[2]||(o[2]=i=>a.auth.password=i),name:"password",placeholder:"Enter password",type:"password"},null,8,["modelValue"])]),_:1}),t(B,{id:"customControlInline",name:"checkbox-1","unchecked-value":"not_accepted",value:"accepted"},{default:s(()=>[l(" Remember me ")]),_:1}),e("input",{type:"hidden",name:"_token",value:p.$csrfToken},null,8,G),e("div",O,[t(v,{disabled:a.processing,ariant:"primary",class:"btn-block",type:"submit",onClick:p.login},{default:s(()=>[l(m(a.processing?"Please wait":"Login"),1)]),_:1},8,["disabled","onClick"])]),e("div",q,[z,e("ul",J,[e("li",W,[t(u,{class:"social-list-item bg-primary text-white border-primary",href:"javascript: void(0);"},{default:s(()=>[Y]),_:1})]),e("li",H,[t(u,{class:"social-list-item bg-info text-white border-info",href:"javascript: void(0);"},{default:s(()=>[K]),_:1})]),e("li",M,[t(u,{class:"social-list-item bg-danger text-white border-danger",href:"javascript: void(0);"},{default:s(()=>[Q]),_:1})])])]),e("div",X,[t(d,{class:"text-muted",to:"/forget-password"},{default:s(()=>[Z,l(" Forgot your password? ")]),_:1})])]),_:3})]),_:3})]),_:3}),e("div",$,[e("p",null,[l(" Don't have an account ? "),t(d,{class:"fw-medium text-primary",to:"/auth/register"},{default:s(()=>[l("Signup now")]),_:1})]),e("p",null,[l(" © "+m(new Date().getFullYear())+" Skote. Crafted with ",1),ee,l(" by Themesbrand ")])])]),_:3})]),_:3})]),_:3})])}const re=E(T,[["render",te]]);export{re as default};
