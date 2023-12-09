import{o,c as n,b as t,_ as b,r as i,a,t as e,j as l,F as _,h as y}from"./app-a0f2337f.js";import{r as g}from"./ExclamationCircleIcon-bd914ee4.js";function f(c,r){return o(),n("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"})])}const A={data(){return{currentDateTime:"",payment_type:""}},props:{order:Object},components:{CheckBadgeIcon:f,ExclamationCircleIcon:g},methods:{getCurrentDateTime(){const c=new Date,r={year:"numeric",month:"long",day:"numeric",hour:"numeric",minute:"numeric",timeZoneName:"short"};this.currentDateTime=c.toLocaleString("id-ID",r)},formatText(c){switch(c){case"credit_card":return"Kartu Kredit";case"gopay":return GoPay;case"qris":return"QRIS";case"gopay":return"GoPay";case"shopeepay":return"ShopeePay";case"bank_transfer":return"Transfer Bank";case"echannel":return"E-Channel";case"cstore":return"Indomaret/Alfamart";case"akulaku":return"Akulaku"}}},created(){this.getCurrentDateTime()}},I={class:"print-content my-8 mx-64"},T={class:"grid grid-cols-2 mb-8"},w={class:"text-end"},k=t("div",{class:"font-bold tracking-wider"},"INVOICE",-1),D={class:"text-xs font-medium text-lime-600"},L={class:"grid grid-cols-2 mb-8"},N=t("div",{class:"text-xs"},[t("div",{class:"mb-2 font-bold"},"DITERBITKAN ATAS NAMA"),t("div",null,"PT TUTA MANDIRI INDONESIA")],-1),R={class:"text-xs"},S=t("div",{class:"mb-2 font-bold"},"UNTUK",-1),B={class:"space-y-2"},C={class:"flex gap-1"},z=t("div",{class:"w-28 text-zinc-500"},"Pembeli",-1),E=t("div",{class:"text-zinc-500"},":",-1),O={class:"font-bold"},P={class:"flex gap-1"},U=t("div",{class:"w-28 text-zinc-500"},"Tanggal Pembelian",-1),K=t("div",{class:"text-zinc-500"},":",-1),M={class:"font-bold"},G={class:"flex gap-1"},H=t("div",{class:"w-28 text-zinc-500"},"Alamat Pengiriman",-1),j=t("div",{class:"text-zinc-500"},":",-1),V={class:"space-y-1"},q={class:"font-bold"},F={class:"mb-6 pb-3 border-b"},J={class:"w-full mb-4"},Q=t("thead",null,[t("tr",{class:"text-xs font-bold border-y bg-gray-100"},[t("td",{class:"w-1/2 ps-4 py-3"},"INFO PRODUK"),t("td",{class:"w-0 py-3 text-end"},"JUMLAH"),t("td",{class:"py-3 text-end"},"HARGA SATUAN"),t("td",{class:"pe-4 py-3 text-end"},"TOTAL HARGA")])],-1),Z={class:"text-xs border-b"},W={class:"w-1/2 ps-4 py-3"},X={class:"py-3 text-end"},Y={class:"py-3 text-end"},$={class:"pe-4 py-3 text-end"},tt={class:"w-1/2 ms-auto"},et={class:"font-bold"},st={class:"text-xs"},ot={class:"pe-4 text-sm text-end"},nt={class:"text-xs"},ct=t("td",{class:"py-3"}," Total Ongkos Kirim ",-1),dt={class:"py-3 pe-4 text-end"},it={class:"text-sm font-bold border-t border-dashed"},at=t("td",{class:"py-3 text-xs"}," TOTAL BELANJA ",-1),rt={class:"pe-4 py-3 text-sm text-end"},lt={class:"grid grid-cols-2 text-xs mb-12"},_t=t("div",null,[t("div",{class:"text-zinc-500 mb-1"},"Kurir:"),t("div",{class:"font-bold"},"JNT - Reguler")],-1),ht={class:"flex items-center justify-between"},mt=t("div",{class:"text-zinc-500 mb-1"},"Metode Pembayaran:",-1),xt={class:"font-bold"},ut={key:0,class:"ps-4 pe-5 py-2 flex gap-2 items-center border-[1.5px] border-green-600 font-semibold text-green-600 text-sm rounded"},vt={key:1,class:"ps-4 pe-5 py-2 flex gap-2 items-center border-[1.5px] border-red-600 font-semibold text-red-600 text-sm rounded"},pt={class:"flex justify-between text-xs"},bt=t("div",null,"Invoice ini sah dan diproses oleh komputer",-1),yt={class:"italic"};function gt(c,r,s,ft,h,m){const x=i("Head"),u=i("Logo"),v=i("CheckBadgeIcon"),p=i("ExclamationCircleIcon");return o(),n(_,null,[a(x,{title:"Invoice"}),t("div",I,[t("div",T,[a(u,{class:"h-10"}),t("div",w,[k,t("div",D,e(s.order.code),1)])]),t("div",L,[N,t("div",R,[S,t("div",B,[t("div",C,[z,E,t("div",O,e(s.order.user),1)]),t("div",P,[U,K,t("div",M,e(s.order.formatted_created_at),1)]),t("div",G,[H,j,t("div",V,[t("div",null,[t("span",q,e(s.order.receiver_name),1),l(" ("+e(s.order.receiver_phone)+") ",1)]),t("div",null,e(s.order.receiver_address),1),t("div",null,e(s.order.district)+", "+e(s.order.city)+", "+e(s.order.zip_code)+" "+e(s.order.province),1)])])])])]),t("div",F,[t("table",J,[Q,t("tbody",null,[(o(!0),n(_,null,y(s.order.order_details,d=>(o(),n("tr",Z,[t("td",W,e(d.name),1),t("td",X,e(d.quantity),1),t("td",Y," Rp"+e(d.price.toLocaleString("id-ID")),1),t("td",$," Rp"+e(d.sub_total.toLocaleString("id-ID")),1)]))),256))])]),t("table",tt,[t("tbody",null,[t("tr",et,[t("td",st," TOTAL HARGA ("+e(s.order.total_quantity)+" BARANG) ",1),t("td",ot," Rp"+e(s.order.total_price.toLocaleString("id-ID")),1)]),t("tr",nt,[ct,t("td",dt," Rp"+e(s.order.shipping_fee.toLocaleString("id-ID")),1)]),t("tr",it,[at,t("td",rt," Rp"+e(s.order.total_payment.toLocaleString("id-ID")),1)])])])]),t("div",lt,[_t,t("div",ht,[t("div",null,[mt,t("div",xt,e(m.formatText(s.order.payment_type)),1)]),s.order.paid_at?(o(),n("div",ut,[a(v,{class:"w-6 h-6"}),l(" LUNAS ")])):(o(),n("div",vt,[a(p,{class:"w-6 h-6"}),l(" BELUM LUNAS ")]))])]),t("div",pt,[bt,t("div",yt,"Dibuat pada "+e(h.currentDateTime),1)])])],64)}const Tt=b(A,[["render",gt]]);export{Tt as default};
