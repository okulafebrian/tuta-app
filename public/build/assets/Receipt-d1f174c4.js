import{_ as b,r as _,o as l,c as a,a as m,b as t,t as e,F as h,h as v,j as u}from"./app-a0f2337f.js";const x={mounted(){this.loadImages().then(()=>{this.print()})},methods:{loadImages(){return new Promise(c=>{const n=document.querySelectorAll("img");let s=0;const i=()=>{s++,s===n.length&&c()};n.forEach(d=>{d.complete?i():d.onload=i})})},print(){window.print()}},props:{shipping:Object,orderBarcode:String,jntBarcode:String}},f={class:"hide w-[10cm] mx-auto flex justify-between items-center mt-8 mb-4"},y=t("div",{class:"font-medium text-sm"},"Ukuran Kertas A6",-1),w={class:"print-content w-[10cm] max-h-[15cm] mx-auto"},k={class:"border border-black"},B={class:"flex items-center justify-between border-b p-3"},I=t("img",{src:"/storage/assets/jnt.png",class:"h-4"},null,-1),N={class:"p-3"},j={class:"mx-4 mb-2"},A=["src"],P={class:"text-center"},R=t("div",{class:"text-[8px]"},"No. Resi Pengiriman",-1),L={class:"font-semibold text-[10px]"},E=t("div",{class:"p-2 my-3 text-center border text-[8px]"},[u(" Penjual "),t("span",{class:"font-semibold"},"tidak perlu bayar"),u(" biaya pengirim ke kurir ")],-1),S={class:"grid grid-cols-2 text-[8px] mb-3"},C={class:"w-full"},T=t("td",{class:"w-16"},"No. Pesanan",-1),F=t("td",{class:"w-4"},":",-1),O={class:"font-semibold"},V=t("td",null,"Berat Barang",-1),q=t("td",null,":",-1),H={class:"font-semibold"},z=t("td",null,"COD",-1),G=t("td",null,":",-1),K={class:"font-semibold"},M={class:"space-y-2"},U=t("div",null,[t("div",{class:"font-semibold mb-1"},"PENGIRIM"),t("div",{class:"font-semibold"}," TUTA OFFICIAL SHOP - 628117676890 "),t("div",null,"Kota Tangerang")],-1),D=t("div",{class:"font-semibold mb-1"},"PENERIMA",-1),J={class:"font-semibold"},Q={class:"text-[8px]"},W=t("div",{class:"font-semibold mb-1"},"DETAIL BARANG",-1),X={class:"w-full"},Y=t("tr",{class:"text-zinc-500 font-semibold border-b"},[t("td",{class:"text-start py-1"},"Nama Barang"),t("td",{class:"text-start py-1"},"Variasi"),t("td",{class:"text-start"},"Jumlah")],-1),Z={class:"py-1"};function $(c,n,s,i,d,r){const p=_("Head"),g=_("Logo");return l(),a(h,null,[m(p,{title:"Cetak Resi"}),t("div",f,[y,t("button",{type:"button",onClick:n[0]||(n[0]=(...o)=>r.print&&r.print(...o)),class:"block bg-lime-600 hover:bg-lime-700 text-white font-medium px-6 py-1.5 text-sm rounded"}," Print ")]),t("div",w,[t("div",k,[t("div",B,[m(g,{class:"h-5"}),I]),t("div",N,[t("div",j,[t("img",{src:"data:image/png;base64,"+s.jntBarcode,alt:"Barcode",class:"w-full h-7"},null,8,A)]),t("div",P,[R,t("div",L,e(s.shipping.awb_no),1)]),E,t("div",S,[t("div",null,[t("table",C,[t("tr",null,[T,F,t("td",O,e(s.shipping.code),1)]),t("tr",null,[V,q,t("td",H,e(s.shipping.order.total_quantity)+" kg",1)]),t("tr",null,[z,G,t("td",K,"Rp"+e(s.shipping.order.payment_type==="cod"?s.shipping.order.total_payment.toLocaleString("id-ID"):0),1)])])]),t("div",M,[U,t("div",null,[D,t("div",J,e(s.shipping.order.receiver_name)+" - "+e(s.shipping.order.receiver_phone),1),t("div",null,e(s.shipping.order.receiver_address),1),t("div",null,e(s.shipping.order.district)+", "+e(s.shipping.order.city)+", "+e(s.shipping.order.province),1)])])]),t("div",Q,[W,t("table",X,[Y,(l(!0),a(h,null,v(s.shipping.order.order_details,o=>(l(),a("tr",null,[t("td",Z,e(o.name),1),t("td",null,e(o.color)+", "+e(o.size),1),t("td",null,e(o.quantity),1)]))),256))])])])])])],64)}const st=b(x,[["render",$]]);export{st as default};
