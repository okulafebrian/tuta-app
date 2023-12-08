import{U as v}from"./UserLayout-acce20e2.js";import C from"./Create-b292c5bc.js";import y from"./Edit-6fee6450.js";import{S as k}from"./Account-2ef3be86.js";import{_ as M,r as a,o as s,c as l,a as c,d as O,e as i,b as t,F as x,f as A,t as m}from"./app-a798eb3e.js";import"./transition-6367855b.js";import"./focus-management-2fce0f0b.js";import"./micro-task-84f21bb7.js";import"./use-outside-click-e3d89dfb.js";import"./CheckCircleIcon-b26d9947.js";import"./XMarkIcon-8c8ee21b.js";const E={data(){return{createIsOpen:!1,editIsOpen:!1,address:""}},components:{Sidebar:k,AddressCreate:C,AddressEdit:y},props:{provinces:Object,addresses:Object},methods:{openCreateModal(){this.createIsOpen=!0},closeCreateModal(){this.createIsOpen=!1},openEditModal(n){this.address=n,this.editIsOpen=!0},closeEditModal(){this.editIsOpen=!1},setMain(n){this.$inertia.put(route("addresses.set-main",n),{},{preserveScroll:!0})},deleteAddress(n){this.$inertia.delete(route("addresses.destroy",n),{},{preserveScroll:!0})}},layout:v},I={class:"xl:px-20 pt-10 pb-24 flex flex-col xl:flex-row xl:gap-24"},g={class:"flex-1 p-4 xl:p-0"},S=t("div",{class:"hidden xl:flex text-2xl font-medium mb-6"},"Daftar Alamat",-1),w={key:0,class:"space-y-4"},B={class:"flex flex-col xl:flex-row justify-between xl:items-center border rounded-2xl p-4 xl:p-6"},j={class:"flex-1 mb-2 xl:mb-0"},D={class:"flex items-center gap-2"},H={class:"font-medium"},N={key:0,class:"bg-lime-600 text-white text-xs font-semibold px-2 py-0.5 rounded-md"},U={class:"text-zinc-600 text-sm"},V={class:"text-zinc-600 line-clamp-1 text-sm"},z={class:"flex gap-6"},F=["onClick"],L=["onClick"],T=["onClick"];function q(n,p,d,G,r,o){const u=a("Head"),f=a("AddressCreate"),h=a("AddressEdit"),b=a("Sidebar");return s(),l(x,null,[c(u,{title:"Daftar Alamat"}),c(f,{isOpen:r.createIsOpen,onCloseModal:o.closeCreateModal,provinces:d.provinces},null,8,["isOpen","onCloseModal","provinces"]),r.address?(s(),O(h,{key:0,isOpen:r.editIsOpen,onCloseModal:o.closeEditModal,address:r.address,provinces:d.provinces},null,8,["isOpen","onCloseModal","address","provinces"])):i("",!0),t("div",I,[c(b),t("div",g,[S,t("button",{type:"button",onClick:p[0]||(p[0]=(...e)=>o.openCreateModal&&o.openCreateModal(...e)),class:"text-lime-600 border border-lime-600 font-medium py-3 w-full rounded-full"}," Tambah Alamat "),d.addresses.length>0?(s(),l("div",w,[(s(!0),l(x,null,A(d.addresses,e=>(s(),l("div",B,[t("div",j,[t("div",D,[t("div",H,m(e.name),1),e.is_main?(s(),l("div",N," Utama ")):i("",!0)]),t("div",U,m(e.phone),1),t("div",V,m(e.detail),1)]),t("div",z,[e.is_main?i("",!0):(s(),l("button",{key:0,type:"button",onClick:_=>o.setMain(e),class:"text-sm font-semibold text-lime-600 hover:text-lime-700"}," Atur sebagai utama ",8,F)),t("button",{type:"button",onClick:_=>o.openEditModal(e),class:"text-sm font-semibold text-lime-600 hover:text-lime-700"}," Edit ",8,L),e.is_main?i("",!0):(s(),l("button",{key:1,type:"button",onClick:_=>o.deleteAddress(e),class:"text-sm font-semibold text-lime-600 hover:text-lime-700"}," Hapus ",8,T))])]))),256))])):i("",!0)])])],64)}const te=M(E,[["render",q]]);export{te as default};