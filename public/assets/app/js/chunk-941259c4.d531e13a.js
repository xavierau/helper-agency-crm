(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-941259c4"],{"13eb":function(t,n,e){"use strict";e("d717")},9497:function(t,n,e){"use strict";e.r(n);var a=function(){var t=this,n=t.$createElement,e=t._self._c||n;return t.trail?e("div",{staticClass:"Trail"},[e("h4",[t._v("Total Invoiced Amount "),e("strong",[t._v(" "+t._s(t._f("formatCurrency")(t.netInvoiceAmount)))])]),e("h4",[t._v("Total Paid Amount "),e("strong",[t._v(" "+t._s(t._f("formatCurrency")(t.trail.total_payment)))])]),e("h4",[t._v("Remaining Amount "),e("strong",[t._v(" "+t._s(t._f("formatCurrency")(t.netInvoiceAmount-t.trail.total_payment)))])]),t._l(t.trail.invoices,(function(n,a){return e("div",{key:a,staticClass:"item-container "},[e("div",{staticClass:"item bg-white"},[t._v(" Client name: "),e("router-link",{attrs:{to:{name:"Client",params:{id:n.client.id}}}},[t._v(t._s(n.client.name)+" ")]),e("br"),t._v(" Invoice Number: "),e("router-link",{attrs:{to:{name:"Invoice",params:{id:n.id}}}},[t._v(t._s(n.invoice_number)+" ")]),e("br"),t._v(" Contract Number: "),e("router-link",{attrs:{to:{name:"Contract",params:{id:n.contract.id}}}},[t._v(t._s(n.contract.contract_number)+" ")]),e("br"),t._v(" Invoice Net Amount: "+t._s(t._f("formatCurrency")(n.total))+" "),e("br"),t._v(" Created At: "+t._s(t._f("formatDate")(n.created_at,"D/M/Y HH:MM"))+" "),e("br"),e("strong",[t._v("Payments")]),e("ul",{staticClass:"list-unstyled"},t._l(n.payments,(function(n){return e("li",{attrs:{ke:n.id}},[t._v(" Payment Amount: "+t._s(t._f("formatCurrency")(n.amount))+" "),e("br"),t._v(" Payment type: "+t._s(n.type)+" "),e("br"),t._v(" Date: "+t._s(t._f("formatDate")(n.created_at,"D/M/Y HH:MM"))+" "),e("br"),t._v(" Note: "+t._s(n.note)+" "),e("br"),t._v(" Attachment: "),n.attachment?e("a",{attrs:{target:"_blank",href:n.attachment}},[t._v("Show attachment")]):e("span",[t._v("No Attachment")])])})),0)],1),t._m(0,!0)])}))],2):t._e()},r=[function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("span",{staticClass:"pointer d-block text-center"},[e("i",{staticClass:"fas fa-chevron-up"})])}],i=e("7ed9"),c=e("ebe3"),o=e("44f1"),s={name:"Trail",data:function(){return{trail:null}},computed:{netInvoiceAmount:function(){return null===this.trail?0:this.trail.invoices[0].total},totalPaidAmount:function(){return null===this.trail?0:this.trail.map((function(t){return t.payments})).flat().reduce((function(t,n){return t+n.amount}),0)}},filters:{formatCurrency:o["b"],formatDate:o["c"]},created:function(){this.fetchTrail()},methods:{fetchTrail:function(){var t=this;i["a"].get(c["a"].trail(this.$route.params.id)).then((function(n){var e=n.data;return t.trail=e})).catch((function(n){return t.$toasted.error("Cannot fetch trail")}))}}},u=s,l=(e("13eb"),e("2877")),f=Object(l["a"])(u,a,r,!1,null,"46bafd85",null);n["default"]=f.exports},d717:function(t,n,e){},ebe3:function(t,n,e){"use strict";var a={list:"/api/agencyfinance/invoices",store:"/api/agencyfinance/invoices",show:function(t){return"/api/agencyfinance/invoices/".concat(t)},update:function(t){return"/api/agencyfinance/invoices/".concat(t)},supersede:function(t){return"/api/agencyfinance/invoices/".concat(t,"/supersede")},trail:function(t){return"/api/agencyfinance/invoices/".concat(t,"/trail")}};n["a"]=a}}]);