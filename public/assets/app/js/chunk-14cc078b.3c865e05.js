(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-14cc078b"],{"290d":function(t,e,a){},3325:function(t,e,a){"use strict";a("290d")},"5c85":function(t,e,a){},"8c0d":function(t,e,a){"use strict";a("5c85")},f593:function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"c-app"},[a("TheSidebar"),a("CWrapper",[a("TheHeader"),a("div",{staticClass:"c-body"},[a("main",{staticClass:"c-main"},[a("CContainer",{attrs:{fluid:""}},[a("transition",{attrs:{name:"fade",mode:"out-in"}},[a("router-view",{key:t.$route.path})],1)],1)],1)]),a("TheFooter")],1)],1)},r=[],s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("CSidebar",{attrs:{fixed:"",minimize:t.minimize,show:t.show},on:{"update:show":function(e){return t.$store.commit("set",["sidebarShow",e])}}},[a("CSidebarBrand",{staticClass:"d-md-down-none",attrs:{to:"/"}},[a("h4",{staticClass:"c-sidebar-brand-full"},[t._v("Sincere System")]),a("h6",{staticClass:"c-sidebar-brand-minimized"},[t._v("Sincere ")])]),a("CRenderFunction",{attrs:{flat:"","content-to-render":t.$options.nav}}),a("CSidebarMinimizer",{staticClass:"d-md-down-none",nativeOn:{click:function(e){return t.$store.commit("set",["sidebarMinimize",!t.minimize])}}})],1)},o=[],i=[{_name:"CSidebarNavItem",name:"Applicants",to:"/applicants/index",icon:"cil-group"}],c=[{_name:"CSidebarNavItem",name:"Clients",to:"/clients/index",icon:"cil-contact"}],l=[{_name:"CSidebarNavItem",name:"Jobs",to:"/jobs",icon:"cil-briefcase"}],d=[],m=[{_name:"CSidebarNavItem",name:"Invoices",to:"/invoices",icon:"cil-money"}],u=[{_name:"CSidebarNavItem",name:"Contracts",to:"/contracts",icon:"cil-description"}],C=[{_name:"CSidebarNavItem",name:"Payments",to:"/payments",icon:"cil-dollar"}],p=[{_name:"CSidebarNavItem",name:"Templates",to:"/templates",icon:"cil-group"}],v=[{_name:"CSidebarNavItem",name:"Credit Note",to:"/credit_notes",icon:"cil-description"}],h=[{_name:"CSidebarNavItem",name:"Pages",to:"/pages",icon:"cil-money"},{_name:"CSidebarNavItem",name:"News",to:"/news",icon:"cil-money"}];function f(t){return w(t)||g(t)||b(t)||_()}function _(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}function b(t,e){if(t){if("string"===typeof t)return y(t,e);var a=Object.prototype.toString.call(t).slice(8,-1);return"Object"===a&&t.constructor&&(a=t.constructor.name),"Map"===a||"Set"===a?Array.from(t):"Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a)?y(t,e):void 0}}function g(t){if("undefined"!==typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}function w(t){if(Array.isArray(t))return y(t)}function y(t,e){(null==e||e>t.length)&&(e=t.length);for(var a=0,n=new Array(e);a<e;a++)n[a]=t[a];return n}var k=[{_name:"CSidebarNav",_children:[{_name:"CSidebarNavItem",name:"Dashboard",to:"/dashboard",icon:"cil-speedometer",badge:{color:"primary",text:"NEW"}}].concat(f(i),f(c),f(l),f(d),f(m),f(u),f(C),f(p),f(v),f(h),[{_name:"CSidebarNavItem",name:"Documentation",to:"/documentation",icon:{name:"cil-book",class:"text-white"},_class:"bg-success text-white"}])}],S={name:"TheSidebar",nav:k,computed:{show:function(){return this.$store.state.sidebarShow},minimize:function(){return this.$store.state.sidebarMinimize}}},I=S,N=a("2877"),H=Object(N["a"])(I,s,o,!1,null,null,null),D=H.exports,x=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("CHeader",{attrs:{fixed:"","with-subheader":"",light:""}},[a("CToggler",{staticClass:"ml-3 d-lg-none",attrs:{"in-header":""},on:{click:function(e){return t.$store.commit("toggleSidebarMobile")}}}),a("CToggler",{staticClass:"ml-3 d-md-down-none",attrs:{"in-header":""},on:{click:function(e){return t.$store.commit("toggleSidebarDesktop")}}}),a("CHeaderBrand",{staticClass:"mx-auto d-lg-none",attrs:{to:"/"}},[a("h4",[t._v("Sincere System")])]),a("CHeaderNav",{staticClass:"d-md-down-none mr-auto"},[a("CHeaderNavItem",{staticClass:"px-3"},[a("CHeaderNavLink",{attrs:{to:"/dashboard"}},[t._v(" Dashboard ")])],1),a("CHeaderNavItem",{staticClass:"px-3"},[a("CHeaderNavLink",{attrs:{to:"/users",exact:""}},[t._v(" Users ")])],1),a("CHeaderNavItem",{staticClass:"px-3"},[a("CDropdown",{staticClass:"m-2",attrs:{"toggler-text":"Settings"}},[a("CHeaderNavLink",{attrs:{to:{name:"Suppliers"}}},[t._v("Supplier")]),a("CHeaderNavLink",{attrs:{to:{name:"Duties"}}},[t._v("Duties")]),a("CHeaderNavLink",{attrs:{to:{name:"Products"}}},[t._v("Products")]),a("CHeaderNavLink",{attrs:{to:{name:"Variants"}}},[t._v("Product Variants")]),a("CHeaderNavLink",{attrs:{to:{name:"Workflows"}}},[t._v("Workflow")]),a("CHeaderNavLink",{attrs:{to:{name:"Contract Dates"}}},[t._v("Contract Date")]),a("CHeaderNavLink",{attrs:{to:{name:"Contract Documents"}}},[t._v("Contract Documents")]),a("CHeaderNavLink",{attrs:{to:{name:"Templates"}}},[t._v("Templates")]),a("CHeaderNavLink",{attrs:{to:{name:"Contract Types"}}},[t._v("Contract Types")]),a("CHeaderNavLink",{attrs:{to:{name:"Organizations"}}},[t._v("Organization ")]),a("CHeaderNavLink",[t._v("Permissions")])],1)],1)],1),a("CHeaderNav",{staticClass:"mr-4"},[a("GlobalSearch"),a("CHeaderNavItem",{staticClass:"d-md-down-none mx-2"},[a("CHeaderNavLink",[a("CIcon",{attrs:{name:"cil-bell"}})],1)],1),a("CHeaderNavItem",{staticClass:"d-md-down-none mx-2"},[a("CHeaderNavLink",[a("CIcon",{attrs:{name:"cil-list"}})],1)],1),a("CHeaderNavItem",{staticClass:"d-md-down-none mx-2"},[a("CHeaderNavLink",[a("CIcon",{attrs:{name:"cil-envelope-open"}})],1)],1),a("TheHeaderDropdownAccnt")],1),a("CSubheader",{staticClass:"px-3"},[a("CBreadcrumbRouter",{staticClass:"border-0 mb-0"})],1)],1)},L=[],T=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("CDropdown",{staticClass:"c-header-nav-items",attrs:{inNav:"",placement:"bottom-end","add-menu-classes":"pt-0"},scopedSlots:t._u([{key:"toggler",fn:function(){return[a("CHeaderNavLink",[a("div",{staticClass:"c-avatar"},[a("img",{staticClass:"c-avatar-img ",attrs:{src:"img/avatars/6.jpg"}})])])]},proxy:!0}])},[a("CDropdownHeader",{staticClass:"text-center",attrs:{tag:"div",color:"light"}},[a("strong",[t._v("Account")])]),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-bell"}}),t._v(" Updates "),a("CBadge",{staticClass:"mfs-auto",attrs:{color:"info"}},[t._v(t._s(t.itemsCount))])],1),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-envelope-open"}}),t._v(" Messages "),a("CBadge",{staticClass:"mfs-auto",attrs:{color:"success"}},[t._v(t._s(t.itemsCount))])],1),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-task"}}),t._v(" Tasks "),a("CBadge",{staticClass:"mfs-auto",attrs:{color:"danger"}},[t._v(t._s(t.itemsCount))])],1),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-comment-square"}}),t._v(" Comments "),a("CBadge",{staticClass:"mfs-auto",attrs:{color:"warning"}},[t._v(t._s(t.itemsCount))])],1),a("CDropdownHeader",{staticClass:"text-center",attrs:{tag:"div",color:"light"}},[a("strong",[t._v("Settings")])]),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-user"}}),t._v(" Profile ")],1),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-settings"}}),t._v(" Settings ")],1),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-dollar"}}),t._v(" Payments "),a("CBadge",{staticClass:"mfs-auto",attrs:{color:"secondary"}},[t._v(t._s(t.itemsCount))])],1),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-file"}}),t._v(" Projects "),a("CBadge",{staticClass:"mfs-auto",attrs:{color:"primary"}},[t._v(t._s(t.itemsCount))])],1),a("CDropdownDivider"),a("CDropdownItem",[a("CIcon",{attrs:{name:"cil-shield-alt"}}),t._v(" Lock Account ")],1),a("CDropdownItem",{on:{click:function(e){return e.preventDefault(),t.logout.apply(null,arguments)}}},[a("CIcon",{attrs:{name:"cil-lock-locked"}}),t._v(" Logout ")],1)],1)},A=[],$=a("d722"),B={name:"TheHeaderDropdownAccnt",data:function(){return{itemsCount:42}},methods:{logout:function(){$["a"].logout().then((function(){return window.location="/"})).catch((function(t){console.log(t),alert("Cannot logout!")}))}}},z=B,j=(a("8c0d"),Object(N["a"])(z,T,A,!1,null,"a418df4e",null)),O=j.exports,P=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("CForm",{attrs:{inline:""},on:{submit:function(e){return e.preventDefault(),t.search.apply(null,arguments)}}},[a("CInput",{staticClass:"mr-sm-2",attrs:{placeholder:"Search",size:"sm"},model:{value:t.keyword,callback:function(e){t.keyword=e},expression:"keyword"}}),a("CButton",{staticClass:"my-2 my-sm-0",attrs:{color:"secondary",size:"sm",type:"submit"}},[t._v(" Search ")])],1),a("CModal",{attrs:{show:t.show,size:"lg",title:"Search Result"},on:{"update:show":function(e){t.show=e}},scopedSlots:t._u([{key:"footer",fn:function(){return[a("button",{staticClass:"btn btn-secondary",on:{click:function(e){t.show=!1}}},[t._v("Close")])]},proxy:!0}])},[t.loading?a("p",{staticClass:"text-center"},[t._v("Loading...")]):a("div",[0===t.results.length?a("span",[t._v("No result found")]):a("div",t._l(t.results,(function(e){return a("router-link",{key:e.type+"_"+e.entity_id,staticClass:"d-block mb-1",attrs:{to:t.getLink(e)},nativeOn:{click:function(e){t.show=!1}}},[t._v(t._s(e.label)+" "),a("span",{staticClass:"badge p-1",class:t.showBadgeClass(e)},[t._v(t._s(t.showBadge(e)))])])})),1)])])],1)},E=[],F=a("7ed9"),M=a("940c"),W={name:"GlobalSearch",data:function(){return{keyword:null,show:!1,loading:!1,results:[]}},methods:{search:function(){var t=this;this.loading=!0,this.results=[],F["a"].get(M["a"].search,{params:{keyword:this.keyword}}).then((function(e){var a=e.data;return t.results=a})).then((function(){return t.loading=!1})).catch((function(t){return console.log(t.response.messsage)})),this.show=!0},showBadge:function(t){switch(t.type){case"Contract":return"Contract";case"Applicant":return"Applicant";case"Client":return"Client"}},showBadgeClass:function(t){switch(t.type){case"Contract":return"badge-success";case"Applicant":return"badge-primary";case"Client":return"badge-info"}},getLink:function(t){switch(t.type){case"Contract":return{name:"Contract",params:{id:t.entity_id}};case"Applicant":return{name:"Applicant",params:{id:t.entity_id}};case"Client":return{name:"Client",params:{id:t.entity_id}}}}}},G=W,J=Object(N["a"])(G,P,E,!1,null,"500ae596",null),R=J.exports,U={name:"TheHeader",components:{GlobalSearch:R,TheHeaderDropdownAccnt:O}},V=U,q=Object(N["a"])(V,x,L,!1,null,null,null),Y=q.exports,K=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("CFooter",{attrs:{fixed:!1}},[a("div",[a("a",{attrs:{href:"https://anacreation.com",target:"_blank"}},[t._v("A & A Creation")]),a("span",{staticClass:"ml-1"},[t._v("© "+t._s((new Date).getFullYear())+" ")])]),a("div",{staticClass:"mfs-auto"})])},Q=[],X={name:"TheFooter"},Z=X,tt=Object(N["a"])(Z,K,Q,!1,null,null,null),et=tt.exports,at={name:"TheContainer",components:{TheSidebar:D,TheHeader:Y,TheFooter:et}},nt=at,rt=(a("3325"),Object(N["a"])(nt,n,r,!1,null,"7c5bc30e",null));e["default"]=rt.exports}}]);