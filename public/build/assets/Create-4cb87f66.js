import{_ as P,S as k,i as V,T as A,r as _,o as a,d as T,f as m,a as f,b as e,j as z,w as r,v,t as c,k as h,c as n,h as b,F as p,q as D,e as U}from"./app-a0f2337f.js";import{r as M}from"./XMarkIcon-3bb62fe2.js";import{U as N,G as B,V as K}from"./dialog-462821c4.js";import"./use-outside-click-eb249b35.js";const S={data(){return{provinces:"",cities:"",districts:"",zipCodes:""}},components:{TransitionRoot:k,TransitionChild:V,Dialog:N,DialogPanel:B,DialogTitle:K,XMarkIcon:M},props:{isOpen:Boolean,mainAddress:Object},methods:{validateName(i){this.form.name.length>i&&(this.form.name=this.form.name.slice(0,i))},validateAddress(i){this.form.detail.length>i&&(this.form.detail=this.form.detail.slice(0,i))},validatePhone(){this.form.phone_number=this.form.phone_number.replace(/[^0-9]/g,""),this.form.phone_number.length>15&&(this.form.phone_number=this.form.phone_number.slice(0,15))},closeModal(){this.$emit("closeModal")},addAddress(){this.form.post(route("addresses.store"),{onSuccess:()=>this.closeModal()})}},computed:{validateForm(){return this.form.name!==""&&this.form.phone_number!==""&&this.form.province_id!==""&&this.form.city_id!==""&&this.form.district_id!==""&&this.form.zip_code_id!==""&&this.form.detail!==""}},watch:{"form.province_id"(){this.form.province_id&&axios.get(route("cities.load",this.form.province_id)).then(i=>{this.cities=i.data.cities.sort((t,d)=>t.name.localeCompare(d.name))}),this.form.city_id=""},"form.city_id"(){this.form.city_id&&axios.get(route("districts.load",this.form.city_id)).then(i=>{this.districts=i.data.districts.sort((t,d)=>t.name.localeCompare(d.name))}),this.form.district_id=""},"form.district_id"(){this.form.district_id&&axios.get(route("zip-codes.load",this.form.district_id)).then(i=>{this.zipCodes=i.data.zipCodes.sort((t,d)=>t.name.localeCompare(d.name))}),this.form.zip_code_id=""}},mounted(){axios.get(route("provinces.load")).then(i=>{this.provinces=i.data.provinces.sort((t,d)=>t.name.localeCompare(d.name))})},setup(i){return{form:A({name:"",phone_number:"",province_id:"",city_id:"",district_id:"",zip_code_id:"",detail:"",is_main:!i.mainAddress})}}},j=e("div",{class:"fixed inset-0 bg-black bg-opacity-50"},null,-1),F={class:"fixed inset-0 top-0 overflow-y-auto"},I={class:"flex justify-center"},L={class:"py-6"},O={class:"mb-4"},R=e("div",{class:"font-semibold text-sm mb-2"},"Nama Lengkap",-1),G={class:"text-right text-xs text-gray-500 mt-1"},q={class:"mb-8"},E=e("div",{class:"font-semibold text-sm mb-2"},"Nomor HP",-1),H={class:"mb-8"},J=e("div",{class:"font-semibold text-sm mb-2"},"Provinsi",-1),X=e("option",{value:"",disabled:""},"Pilih Provinsi",-1),Q=["value"],W={class:"mb-8"},Y=e("div",{class:"font-semibold text-sm mb-2"},"Kota",-1),Z=["disabled"],$=e("option",{value:"",disabled:""},"Pilih Kota",-1),ee=["value"],te={class:"mb-8"},oe=e("div",{class:"font-semibold text-sm mb-2"},"Kecamatan",-1),se=["disabled"],ie=e("option",{value:"",disabled:""},"Pilih Kecamatan",-1),de=["value"],ae={class:"mb-8"},le=e("div",{class:"font-semibold text-sm mb-2"},"Kode Pos",-1),ne=["disabled"],re=e("option",{value:"",disabled:""},"Pilih Kode Pos",-1),me=["value"],ce={class:"mb-4"},_e=e("div",{class:"font-semibold text-sm mb-2"},"Alamat Lengkap",-1),fe={class:"text-right text-xs text-gray-500"},ue={class:"flex items-center"},he=["disabled"],be=e("label",{for:"set-main",class:"ml-3 select-none"}," Jadikan alamat utama ",-1),pe={class:"py-2 flex xl:justify-end gap-2"},ve=["disabled"];function xe(i,t,d,s,u,l){const x=_("TransitionChild"),g=_("DialogTitle"),y=_("DialogPanel"),w=_("Dialog"),C=_("TransitionRoot");return a(),T(C,{appear:"",show:d.isOpen,as:"template"},{default:m(()=>[f(w,{as:"div",class:"relative z-10"},{default:m(()=>[f(x,{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0"},{default:m(()=>[j]),_:1}),e("div",F,[e("div",I,[f(x,{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-300 ease-out","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95"},{default:m(()=>[f(y,{class:"w-full xl:w-[45%] xl:rounded-md flex flex-col xl:my-6 transform bg-white align-middle shadow-xl transition-all px-4 xl:px-8 py-6"},{default:m(()=>[f(g,{class:"text-xl text-center font-bold"},{default:m(()=>[z(" Alamat Baru ")]),_:1}),e("div",L,[e("div",O,[R,r(e("input",{"onUpdate:modelValue":t[0]||(t[0]=o=>s.form.name=o),onInput:t[1]||(t[1]=o=>l.validateName(30)),type:"text",class:"text-sm border-gray-300 rounded-md w-full"},null,544),[[v,s.form.name]]),e("div",G,c(s.form.name.length)+"/30 ",1)]),e("div",q,[E,r(e("input",{"onUpdate:modelValue":t[2]||(t[2]=o=>s.form.phone_number=o),onInput:t[3]||(t[3]=(...o)=>l.validatePhone&&l.validatePhone(...o)),type:"text",placeholder:"08xxxxxxxxxx",class:"text-sm border-gray-300 rounded-md w-full"},null,544),[[v,s.form.phone_number]])]),e("div",H,[J,r(e("select",{"onUpdate:modelValue":t[4]||(t[4]=o=>s.form.province_id=o),class:"text-sm border-gray-300 rounded-md w-full"},[X,(a(!0),n(p,null,b(u.provinces,o=>(a(),n("option",{value:o.id},c(o.name),9,Q))),256))],512),[[h,s.form.province_id]])]),e("div",W,[Y,r(e("select",{"onUpdate:modelValue":t[5]||(t[5]=o=>s.form.city_id=o),class:"text-sm border-gray-300 rounded-md w-full disabled:bg-gray-200",disabled:!s.form.province_id},[$,(a(!0),n(p,null,b(u.cities,o=>(a(),n("option",{value:o.id},c(o.name),9,ee))),256))],8,Z),[[h,s.form.city_id]])]),e("div",te,[oe,r(e("select",{"onUpdate:modelValue":t[6]||(t[6]=o=>s.form.district_id=o),class:"text-sm border-gray-300 rounded-md w-full disabled:bg-gray-200",disabled:!s.form.city_id},[ie,(a(!0),n(p,null,b(u.districts,o=>(a(),n("option",{value:o.id},c(o.name),9,de))),256))],8,se),[[h,s.form.district_id]])]),e("div",ae,[le,r(e("select",{"onUpdate:modelValue":t[7]||(t[7]=o=>s.form.zip_code_id=o),class:"text-sm border-gray-300 rounded-md w-full disabled:bg-gray-200",disabled:!s.form.district_id},[re,(a(!0),n(p,null,b(u.zipCodes,o=>(a(),n("option",{value:o.id},c(o.name),9,me))),256))],8,ne),[[h,s.form.zip_code_id]])]),e("div",ce,[_e,r(e("textarea",{rows:"3","onUpdate:modelValue":t[8]||(t[8]=o=>s.form.detail=o),onInput:t[9]||(t[9]=o=>l.validateAddress(200)),class:"text-sm border-gray-300 rounded-md w-full resize-none"},null,544),[[v,s.form.detail]]),e("div",fe,c(s.form.detail.length)+"/200 ",1)]),e("div",ue,[r(e("input",{id:"set-main",type:"checkbox","onUpdate:modelValue":t[10]||(t[10]=o=>s.form.is_main=o),disabled:!d.mainAddress,class:"w-5 h-5 text-lime-600 bg-gray-100 border-gray-300 rounded focus:ring-lime-500 disabled:text-lime-600/50"},null,8,he),[[D,s.form.is_main]]),be])]),e("div",pe,[d.mainAddress?(a(),n("button",{key:0,type:"button",onClick:t[11]||(t[11]=(...o)=>l.closeModal&&l.closeModal(...o)),class:"px-8 py-2 rounded-full border font-semibold w-1/2 xl:w-auto"}," Batal ")):U("",!0),e("button",{type:"button",onClick:t[12]||(t[12]=(...o)=>l.addAddress&&l.addAddress(...o)),disabled:!l.validateForm,class:"px-8 py-2 rounded-full bg-lime-600 hover:bg-lime-700 disabled:bg-slate-200 disabled:text-slate-500 font-semibold text-white w-1/2 xl:w-auto"}," Simpan ",8,ve)])]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"])}const Pe=P(S,[["render",xe]]);export{Pe as default};