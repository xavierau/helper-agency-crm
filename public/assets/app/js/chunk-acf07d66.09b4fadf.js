(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-acf07d66"],{"11c1":function(t,e,a){var n=a("c437"),o=a("c64e"),r=o;r.v1=n,r.v4=o,t.exports=r},2366:function(t,e){for(var a=[],n=0;n<256;++n)a[n]=(n+256).toString(16).substr(1);function o(t,e){var n=e||0,o=a;return[o[t[n++]],o[t[n++]],o[t[n++]],o[t[n++]],"-",o[t[n++]],o[t[n++]],"-",o[t[n++]],o[t[n++]],"-",o[t[n++]],o[t[n++]],"-",o[t[n++]],o[t[n++]],o[t[n++]],o[t[n++]],o[t[n++]],o[t[n++]]].join("")}t.exports=o},4151:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("HK Code")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"text"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},o=[],r={name:"ApplicantHKCode",props:{name:{type:String,default:"hk_code"},value:{type:String,default:null},size:{type:String,default:"col-12"}}},i=r,l=a("2877"),s=Object(l["a"])(i,n,o,!1,null,"1db1aaf3",null);e["a"]=s.exports},4314:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Supplier")]),a("select",{staticClass:"form-control",attrs:{name:t.name},on:{input:function(e){return t.$emit("input",e.target.value)}}},t._l(t.suppliers,(function(e){return a("option",{key:e.id,domProps:{value:e.id,selected:t.value===e.id}},[t._v(t._s(e.name)+"("+t._s(e.code)+") ")])})),0)])},o=[],r=a("7ed9"),i=a("cb50"),l={name:"ApplicantSupplier",props:{name:{type:String,default:"supplier_id"},value:{type:Number,default:null},size:{type:String,default:"col-12"}},data:function(){return{suppliers:[]}},created:function(){var t=this;r["a"].get(i["a"].list).then((function(e){var a=e.data;return t.suppliers=a}))}},s=l,u=a("2877"),c=Object(u["a"])(s,n,o,!1,null,"2938ab09",null);e["a"]=c.exports},"56e2":function(t,e,a){},"5e58":function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("PT Code")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"text"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},o=[],r={name:"ApplicantPTCode",props:{name:{type:String,default:"pt_code"},value:{type:String,default:null},size:{type:String,default:"col-12"}}},i=r,l=a("2877"),s=Object(l["a"])(i,n,o,!1,null,"313166f3",null);e["a"]=s.exports},6983:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Marital Status")]),a("select",{staticClass:"form-control",attrs:{name:t.name},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}},[a("option",{attrs:{value:"single"}},[t._v("Single")]),a("option",{attrs:{value:"married"}},[t._v("Married")])])])},o=[],r={name:"ApplicantMaritalStatus",props:{name:{type:String,default:"marital_status"},value:{type:String,default:null},size:{type:String,default:"col-12 col-md-6"}}},i=r,l=a("2877"),s=Object(l["a"])(i,n,o,!1,null,"16167abc",null);e["a"]=s.exports},7443:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Height")]),a("div",{staticClass:"input-group"},[a("input",{staticClass:"form-control",attrs:{name:t.name,type:"number",min:"0",step:"0.1"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}}),t._m(0)])])},o=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"input-group-append"},[a("span",{staticClass:"input-group-text"},[t._v("cm")])])}],r={name:"ApplicantHeight",props:{name:{type:String,default:"height"},value:{type:Number,default:0},size:{type:String,default:"col-12 col-md-6"}}},i=r,l=a("2877"),s=Object(l["a"])(i,n,o,!1,null,"25174622",null);e["a"]=s.exports},bca8:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Weight")]),a("div",{staticClass:"input-group"},[a("input",{staticClass:"form-control",attrs:{name:t.name,type:"number",min:"0",step:"0.1"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}}),t._m(0)])])},o=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"input-group-append"},[a("span",{staticClass:"input-group-text"},[t._v("kg")])])}],r={name:"ApplicantWeight",props:{name:{type:String,default:"weight"},value:{type:Number,default:null},size:{type:String,default:"col-12 col-md-6"}}},i=r,l=a("2877"),s=Object(l["a"])(i,n,o,!1,null,"0ab7cbed",null);e["a"]=s.exports},c437:function(t,e,a){var n,o,r=a("e1f4"),i=a("2366"),l=0,s=0;function u(t,e,a){var u=e&&a||0,c=e||[];t=t||{};var m=t.node||n,p=void 0!==t.clockseq?t.clockseq:o;if(null==m||null==p){var f=r();null==m&&(m=n=[1|f[0],f[1],f[2],f[3],f[4],f[5]]),null==p&&(p=o=16383&(f[6]<<8|f[7]))}var d=void 0!==t.msecs?t.msecs:(new Date).getTime(),v=void 0!==t.nsecs?t.nsecs:s+1,g=d-l+(v-s)/1e4;if(g<0&&void 0===t.clockseq&&(p=p+1&16383),(g<0||d>l)&&void 0===t.nsecs&&(v=0),v>=1e4)throw new Error("uuid.v1(): Can't create more than 10M uuids/sec");l=d,s=v,o=p,d+=122192928e5;var _=(1e4*(268435455&d)+v)%4294967296;c[u++]=_>>>24&255,c[u++]=_>>>16&255,c[u++]=_>>>8&255,c[u++]=255&_;var b=d/4294967296*1e4&268435455;c[u++]=b>>>8&255,c[u++]=255&b,c[u++]=b>>>24&15|16,c[u++]=b>>>16&255,c[u++]=p>>>8|128,c[u++]=255&p;for(var y=0;y<6;++y)c[u+y]=m[y];return e||i(c)}t.exports=u},c64e:function(t,e,a){var n=a("e1f4"),o=a("2366");function r(t,e,a){var r=e&&a||0;"string"==typeof t&&(e="binary"===t?new Array(16):null,t=null),t=t||{};var i=t.random||(t.rng||n)();if(i[6]=15&i[6]|64,i[8]=63&i[8]|128,e)for(var l=0;l<16;++l)e[r+l]=i[l];return e||o(i)}t.exports=r},caf3:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Nationality")]),a("select",{staticClass:"form-control",attrs:{name:"nationality"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}},t._l(t.nationalities,(function(e){return a("option",{key:e.code,domProps:{value:e.code,textContent:t._s(e.label)}})})),0)])},o=[],r=a("7ed9"),i=a("1bbb"),l={name:"ApplicantNationality",props:{name:{type:String,default:"gender"},value:{type:String,default:null},size:{type:String,default:"col-12 col-md-6"}},data:function(){return{nationalities:[]}},created:function(){var t=this;r["a"].get(i["a"].nationalities).then((function(e){var a=e.data;return t.nationalities=a})).catch((function(t){return console.log(t)}))}},s=l,u=a("2877"),c=Object(u["a"])(s,n,o,!1,null,"630bacc2",null);e["a"]=c.exports},cb50:function(t,e,a){"use strict";var n={list:"/api/agencycore/suppliers",store:"/api/agencycore/suppliers",edit:function(t){return"/api/agencycore/suppliers/".concat(t)}};e["a"]=n},e1f4:function(t,e){var a="undefined"!=typeof crypto&&crypto.getRandomValues&&crypto.getRandomValues.bind(crypto)||"undefined"!=typeof msCrypto&&"function"==typeof window.msCrypto.getRandomValues&&msCrypto.getRandomValues.bind(msCrypto);if(a){var n=new Uint8Array(16);t.exports=function(){return a(n),n}}else{var o=new Array(16);t.exports=function(){for(var t,e=0;e<16;e++)0===(3&e)&&(t=4294967296*Math.random()),o[e]=t>>>((3&e)<<3)&255;return o}}},e4c3:function(t,e,a){"use strict";a("56e2")},e5f2:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Gender")]),a("select",{staticClass:"form-control",attrs:{name:t.name},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}},[a("option",{attrs:{value:"female"}},[t._v("Female")]),a("option",{attrs:{value:"male"}},[t._v("Male")])])])},o=[],r={name:"ApplicantGender",props:{name:{type:String,default:"gender"},value:{type:String,default:null},size:{type:String,default:"col-12 col-md-6"}}},i=r,l=a("2877"),s=Object(l["a"])(i,n,o,!1,null,"1b80ef8b",null);e["a"]=s.exports},ff37:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("form",{staticClass:"form"},[a("BasicInfoForm",{staticClass:"m-1 p-1 border",attrs:{"form-data":t.formData},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}}),a("identity-document-info-form",{staticClass:"m-1 p-1 border",attrs:{"form-data":t.formData},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}}),a("family-info-form",{staticClass:"m-1 p-1 border",attrs:{"form-data":t.formData},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}}),a("education-info-form",{staticClass:"m-1 p-1 border",attrs:{"form-data":t.formData},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}}),a("JobInfoForm",{staticClass:"m-1 mb-3 p-1 border",attrs:{"form-data":t.formData},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}}),a("HolidayArrangementForm",{staticClass:"m-1 mb-3 p-1 border",attrs:{"form-data":t.formData},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}}),a("ApplicantQuestionsForm",{staticClass:"m-1 mb-3 p-1 border",attrs:{"form-data":t.formData.questions},on:{"update:formData":function(e){return t.$set(t.formData,"questions",e)},"update:form-data":function(e){return t.$set(t.formData,"questions",e)}}}),a("experience-info-form",{staticClass:"m-1 mb-3 p-1 border",attrs:{"form-data":t.formData.experience},on:{"update:formData":function(e){return t.$set(t.formData,"experience",e)},"update:form-data":function(e){return t.$set(t.formData,"experience",e)},"remove-experience":t.removeExperience,"add-experience":t.addExperience}})],1)},o=[],r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("section",{staticClass:"BasicInform row"},[a("div",{staticClass:"col-12"},[a("h5",[t._v("Current Location")]),a("div",{staticClass:"row"},[a("div",{staticClass:"form-group col-3 "},[a("label",[t._v("Country")]),a("SelectCountry",{attrs:{"form-data":t.formData,required:"","form-data-key":"current_country"},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}})],1),a("div",{staticClass:"form-group col-3"},[a("label",[t._v("Region/State")]),a("SelectCountryRegion",{attrs:{"form-data":t.formData,"form-data-key":"current_state","country-key":"current_country"},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}})],1),"hong_kong"===t.formData.current_country?a("div",{staticClass:"form-group col-6"},[a("label",[t._v("Address")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.living_place,expression:"formData.living_place"}],staticClass:"form-control",attrs:{name:"living_place",type:"text"},domProps:{value:t.formData.living_place},on:{input:function(e){e.target.composing||t.$set(t.formData,"living_place",e.target.value)}}})]):t._e()])]),a("div",{staticClass:"col-12"},[a("div",{staticClass:"row"},[a("ApplicantHKCode",{attrs:{size:"col"},model:{value:t.formData.hk_code,callback:function(e){t.$set(t.formData,"hk_code",e)},expression:"formData.hk_code"}}),a("ApplicantSupplier",{attrs:{size:"col"},model:{value:t.formData.supplier_id,callback:function(e){t.$set(t.formData,"supplier_id",t._n(e))},expression:"formData.supplier_id"}}),a("ApplicantPTCode",{attrs:{size:"col"},model:{value:t.formData.pt_code,callback:function(e){t.$set(t.formData,"pt_code",e)},expression:"formData.pt_code"}})],1)]),a("h5",{staticClass:"col-12"},[t._v("Personal Info")]),a("div",{staticClass:"form-group col-12"},[a("label",[t._v("Name")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.name,expression:"formData.name"}],staticClass:"form-control",attrs:{name:"name",type:"text"},domProps:{value:t.formData.name},on:{input:function(e){e.target.composing||t.$set(t.formData,"name",e.target.value)}}})]),a("div",{staticClass:"form-group col-12"},[a("label",[t._v("Date for birth")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.date_of_birth,expression:"formData.date_of_birth"}],staticClass:"form-control",attrs:{name:"date_of_birth",type:"date"},domProps:{value:t.formData.date_of_birth},on:{input:function(e){e.target.composing||t.$set(t.formData,"date_of_birth",e.target.value)}}})]),a("ApplicantGender",{model:{value:t.formData.gender,callback:function(e){t.$set(t.formData,"gender",e)},expression:"formData.gender"}}),a("div",{staticClass:"form-group col-12 col-md-6"},[a("label",[t._v("Phone number")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.phone,expression:"formData.phone"}],staticClass:"form-control",attrs:{name:"phone",type:"text"},domProps:{value:t.formData.phone},on:{input:function(e){e.target.composing||t.$set(t.formData,"phone",e.target.value)}}})]),a("ApplicantNationality",{model:{value:t.formData.nationality,callback:function(e){t.$set(t.formData,"nationality",e)},expression:"formData.nationality"}}),a("ApplicantMaritalStatus",{model:{value:t.formData.marital_status,callback:function(e){t.$set(t.formData,"marital_status",e)},expression:"formData.marital_status"}}),a("ApplicantHeight",{model:{value:t.formData.height,callback:function(e){t.$set(t.formData,"height",t._n(e))},expression:"formData.height"}}),a("ApplicantWeight",{model:{value:t.formData.weight,callback:function(e){t.$set(t.formData,"weight",t._n(e))},expression:"formData.weight"}}),a("div",{staticClass:"form-group col-12"},[a("label",[t._v("Religion")]),a("select",{directives:[{name:"model",rawName:"v-model",value:t.formData.religion,expression:"formData.religion"}],staticClass:"form-control",attrs:{name:"religion"},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(t.formData,"religion",e.target.multiple?a:a[0])}}},[a("option",{attrs:{value:"Christian"}},[t._v("Christian")]),a("option",{attrs:{value:"Islam"}},[t._v("Islam")]),a("option",{attrs:{value:"Buddhists"}},[t._v("Buddhists")]),a("option",{attrs:{value:"Unaffiliated"}},[t._v("Unaffiliated")])])]),a("div",{staticClass:"col-12"},[a("LanguageForm",{attrs:{"form-data":t.formData},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}})],1),a("h5",{staticClass:"col-12"},[t._v("Communication")]),a("div",{staticClass:"form-group col-12 col-md-6"},[a("label",[t._v("Email")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.email,expression:"formData.email"}],staticClass:"form-control",attrs:{name:"email",type:"email"},domProps:{value:t.formData.email},on:{input:function(e){e.target.composing||t.$set(t.formData,"email",e.target.value)}}})]),a("div",{staticClass:"form-group col-12 col-md-6"},[a("label",[t._v("Facebook")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.facebook,expression:"formData.facebook"}],staticClass:"form-control",attrs:{name:"facebook",type:"text"},domProps:{value:t.formData.facebook},on:{input:function(e){e.target.composing||t.$set(t.formData,"facebook",e.target.value)}}})])],1)},i=[],l=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("select",{staticClass:"form-control",attrs:{name:"country",required:t.required},on:{change:t.updateData}},[a("option",{domProps:{value:null}},[t._v("--- Please Select ---")]),t._l(t.countries,(function(e){return a("option",{key:e.value,domProps:{value:e.value,selected:t.isSelected(e)}},[t._v(t._s(e.label)+" ")])}))],2)},s=[],u={name:"SelectCountry",props:{formData:{type:Object,required:!0},formDataKey:{type:String,required:!0},required:{type:Boolean,default:!1}},data:function(){return{countries:[{value:"hong_kong",label:"Hong Kong"},{value:"indonesia",label:"Indonesia"},{value:"philippines",label:"Philippines"},{value:"taiwan",label:"Taiwan"},{value:"singapore",label:"Singapore"}]}},methods:{updateData:function(t){this.formData[this.formDataKey]=t.target.value},isSelected:function(t){return t.value===this.formData[this.formDataKey]}}},c=u,m=a("2877"),p=Object(m["a"])(c,l,s,!1,null,"033f5fad",null),f=p.exports,d=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("select",{directives:[{name:"model",rawName:"v-model",value:t.formData.current_state,expression:"formData.current_state"}],staticClass:"form-control",on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(t.formData,"current_state",e.target.multiple?a:a[0])}}},t._l(t.states[t.formData[t.countryKey]],(function(e){return a("option",{key:e,domProps:{value:e}},[t._v(" "+t._s(e)+" ")])})),0)},v=[],g={hong_kong:["Central and Western","Eastern","Southern","Wan Chai","Sham Shui Po","Kowloon City","Kwun Tong","Wong Tai Sin","Yau Tsim Mong","Islands","Kwai Tsing","North","Sai Kung","Sha Tin","Tai Po","Tsuen Wan","Tuen Mun","Yuen Long"],indonesia:["Aceh","Bali","Bangka Belitung Islands","Banten","Bengkulu","Central Java","Central Kalimantan","Central Sulawesi","East Java","East Kalimantan","East Nusa Tenggara","Gorontalo","Special Capital Region of Jakarta","Jambi","Lampung","Maluku","North Kalimantan","North Maluku","North Sulawesi","North Sumatra","Papua","Riau","Riau Islands","Southeast Sulawesi","South Kalimantan","South Sulawesi","South Sumatra","West Java","West Kalimantan","West Nusa Tenggara","West Papua","West Sulawesi","West Sumatra","Special Region of Yogyakarta"]},_={name:"SelectCountryRegion",props:{formData:{type:Object,required:!0},formDataKey:{type:String,required:!0},countryKey:{type:String,required:!0},required:{type:Boolean,default:!1}},computed:{states:function(){return g}}},b=_,y=Object(m["a"])(b,d,v,!1,null,"2dace7c0",null),h=y.exports,D=a("7443"),C=a("bca8"),x=a("e5f2"),S=a("caf3"),$=a("6983"),k=a("4151"),E=a("5e58"),A=a("4314"),w=a("7e69"),P={name:"BasicInfoForm",components:{ApplicantMaritalStatus:$["a"],ApplicantNationality:S["a"],SelectCountry:f,SelectCountryRegion:h,ApplicantHeight:D["a"],ApplicantWeight:C["a"],ApplicantGender:x["a"],ApplicantHKCode:k["a"],ApplicantPTCode:E["a"],ApplicantSupplier:A["a"],LanguageForm:w["a"]},props:{formData:{type:Object,required:!0}}},z=P,O=Object(m["a"])(z,r,i,!1,null,"3a93c20c",null),N=O.exports,j=a("c329"),K=a("eb78"),T=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("section",{staticClass:"BasicInform row"},[a("div",{staticClass:"col-12"},[a("h4",[t._v(" Working Experience Record "),a("button",{staticClass:"btn btn-success btn-sm",attrs:{type:"button"},on:{click:function(e){t.$emit("add-experience",t.getExperienceObject())}}},[t._v("Add Experience Record ")])]),t._l(t.formData,(function(e,n){return a("fieldset",{key:e.uuid,staticClass:"col-12"},[a("legend",[t._v("Working Experience "+t._s(n+1)+" "),a("button",{staticClass:"btn btn-sm btn-danger",attrs:{type:"button"},on:{click:function(a){return t.$emit("remove-experience",e.uuid)}}},[a("i",{staticClass:"fa fa-minus"})])]),a("div",{staticClass:"row"},[a("div",{staticClass:"form-group col-sm-6"},[a("label",[t._v("Location")]),a("SelectCountry",{attrs:{"form-data":e,"form-data-key":"location",required:""}})],1),a("Position",{model:{value:e.position,callback:function(a){t.$set(e,"position",a)},expression:"exp.position"}}),a("FromDate",{model:{value:e.from,callback:function(a){t.$set(e,"from",a)},expression:"exp.from"}}),a("ToDate",{model:{value:e.from,callback:function(a){t.$set(e,"from",a)},expression:"exp.from"}}),a("CompletionStatus",{model:{value:e.status,callback:function(a){t.$set(e,"status",a)},expression:"exp.status"}}),a("HouseSize",{model:{value:e.house_size,callback:function(a){t.$set(e,"house_size",t._n(a))},expression:"exp.house_size"}}),a("NumberOfAdult",{model:{value:e.number_of_adult,callback:function(a){t.$set(e,"number_of_adult",t._n(a))},expression:"exp.number_of_adult"}}),a("AgeOfAdults",{model:{value:e.age_of_adult,callback:function(a){t.$set(e,"age_of_adult",a)},expression:"exp.age_of_adult"}}),a("NumberOfChildren",{model:{value:e.number_of_children,callback:function(a){t.$set(e,"number_of_children",t._n(a))},expression:"exp.number_of_children"}}),a("AgeOfChildren",{model:{value:e.age_of_children,callback:function(a){t.$set(e,"age_of_children",a)},expression:"exp.age_of_children"}}),a("NumberOfElderly",{model:{value:e.number_of_elderly,callback:function(a){t.$set(e,"number_of_elderly",t._n(a))},expression:"exp.number_of_elderly"}}),a("AgeOfElderly",{model:{value:e.age_of_elderly,callback:function(a){t.$set(e,"age_of_elderly",a)},expression:"exp.age_of_elderly"}}),a("Description",{model:{value:e.description,callback:function(a){t.$set(e,"description",a)},expression:"exp.description"}}),a("DutyExperiences",{attrs:{size:"col-12"},model:{value:e.duties,callback:function(a){t.$set(e,"duties",a)},expression:"exp.duties"}})],1)])}))],2)])},I=[],F=a("11c1"),W=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Position")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"string",autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},q=[],B={name:"Position",props:{name:{type:String,default:"position"},value:{type:String,default:""},size:{type:String,default:"col-12 col-md-6"}}},R=B,H=Object(m["a"])(R,W,q,!1,null,"10a6c567",null),M=H.exports,J=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("From Date")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"date",autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},L=[],G={name:"FromDate",props:{name:{type:String,default:"from_date"},value:{type:String,default:""},size:{type:String,default:"col-12 col-md-6"}}},V=G,Y=Object(m["a"])(V,J,L,!1,null,"2aabf67d",null),U=Y.exports,Q=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("To Date")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"date",autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},X=[],Z={name:"ToDate",props:{name:{type:String,default:"to_date"},value:{type:String,default:""},size:{type:String,default:"col-12 col-md-6"}}},tt=Z,et=Object(m["a"])(tt,Q,X,!1,null,"438e53f9",null),at=et.exports,nt=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Status")]),a("select",{staticClass:"form-control",attrs:{name:t.name,required:""},on:{input:function(e){return t.$emit("input",e.target.value)}}},[a("option",{attrs:{value:"finished"},domProps:{selected:"finished"===t.value}},[t._v("Finished")]),a("option",{attrs:{value:"terminated"},domProps:{selected:"terminated"===t.value}},[t._v("Terminated")])])])},ot=[],rt={name:"CompletionStatus",props:{name:{type:String,default:"status"},value:{type:String,default:""},size:{type:String,default:"col-12 col-md-6"}}},it=rt,lt=Object(m["a"])(it,nt,ot,!1,null,"374c91ae",null),st=lt.exports,ut=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("House Size")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"string",min:"0",autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},ct=[],mt={name:"HouseSize",props:{name:{type:String,default:"house_size"},value:{type:Number,default:null},size:{type:String,default:"col-12 col-md-6"}}},pt=mt,ft=Object(m["a"])(pt,ut,ct,!1,null,"b5358a84",null),dt=ft.exports,vt=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Number of adult")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"number",min:"0",autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},gt=[],_t={name:"NumberOfAdult",props:{name:{type:String,default:"number_of_adult"},value:{type:Number},size:{type:String,default:"col-12 col-md-6"}}},bt=_t,yt=Object(m["a"])(bt,vt,gt,!1,null,"40ee516b",null),ht=yt.exports,Dt=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Age of adults")]),a("input",{staticClass:"form-control",attrs:{name:t.name,autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},Ct=[],xt={name:"AgeOfAdults",props:{name:{type:String,default:"age_of_sons"},value:{type:String,default:""},size:{type:String,default:"col-12 col-md-6"}}},St=xt,$t=Object(m["a"])(St,Dt,Ct,!1,null,"7bd257d3",null),kt=$t.exports,Et=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Number of children")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"number",min:"0",autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},At=[],wt={name:"NumberOfChildren",props:{name:{type:String,default:"number_of_children"},value:{type:Number},size:{type:String,default:"col-12 col-md-6"}}},Pt=wt,zt=Object(m["a"])(Pt,Et,At,!1,null,"0f578b7b",null),Ot=zt.exports,Nt=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Age of children")]),a("input",{staticClass:"form-control",attrs:{name:t.name,autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},jt=[],Kt={name:"AgeOfChildren",props:{name:{type:String,default:"age_of_children"},value:{type:String,default:""},size:{type:String,default:"col-12 col-md-6"}}},Tt=Kt,It=Object(m["a"])(Tt,Nt,jt,!1,null,"773ec5aa",null),Ft=It.exports,Wt=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Number of elderly")]),a("input",{staticClass:"form-control",attrs:{name:t.name,type:"number",min:"0",autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},qt=[],Bt={name:"NumberOfElderly",props:{name:{type:String,default:"number_of_elderly"},value:{type:Number},size:{type:String,default:"col-12 col-md-6"}}},Rt=Bt,Ht=Object(m["a"])(Rt,Wt,qt,!1,null,"7f56f82a",null),Mt=Ht.exports,Jt=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Age of elderly")]),a("input",{staticClass:"form-control",attrs:{name:t.name,autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},Lt=[],Gt={name:"AgeOfElderly",props:{name:{type:String,default:"age_of_elderly"},value:{type:String,default:""},size:{type:String,default:"col-12 col-md-6"}}},Vt=Gt,Yt=Object(m["a"])(Vt,Jt,Lt,!1,null,"30b61def",null),Ut=Yt.exports,Qt=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Description")]),a("textarea",{staticClass:"form-control",attrs:{name:t.name,autocomplete:"true"},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})])},Xt=[],Zt={name:"Description",props:{name:{type:String,default:"age_of_elderly"},value:{type:String,default:""},size:{type:String,default:"col-12"}}},te=Zt,ee=Object(m["a"])(te,Qt,Xt,!1,null,"44c2cb8b",null),ae=ee.exports,ne=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group",class:t.size},[a("label",[t._v("Duty Experiences")]),a("v-select",{attrs:{options:t.duties,value:t.value,label:"label",reduce:function(t){return t.id},multiple:""},on:{input:t.onChange},scopedSlots:t._u([{key:"option",fn:function(e){return[a("div",{staticClass:"py-1 px-2 rounded",class:{"bg-light":t.isSelected(e.id)}},[t._v(" "+t._s(e.label)+" ")])]}}])})],1)},oe=[],re=a("7ed9"),ie=a("1bbb"),le=a("4a7a"),se=a.n(le),ue={name:"DutyExperiences",components:{vSelect:se.a},props:{name:{type:String,default:"available_date"},value:{type:Array,default:function(){return[]}},size:{type:String,default:"col-12 col-md-6"}},data:function(){return{duties:[]}},created:function(){this.fetchDuties()},methods:{fetchDuties:function(){var t=this;re["a"].get(ie["a"].duties).then((function(e){var a=e.data;return t.duties=a})).catch((function(t){return console.log(t)}))},isSelected:function(t){return this.value.indexOf(t.id)>-1},onChange:function(t){this.isSelected(t)||this.$emit("input",t)}}},ce=ue,me=Object(m["a"])(ce,ne,oe,!1,null,"9ef9d2ae",null),pe=me.exports,fe={name:"ExperienceInfoForm",components:{DutyExperiences:pe,Description:ae,SelectCountry:f,Position:M,FromDate:U,ToDate:at,CompletionStatus:st,HouseSize:dt,NumberOfAdult:ht,AgeOfAdults:kt,NumberOfChildren:Ot,AgeOfChildren:Ft,NumberOfElderly:Mt,AgeOfElderly:Ut},props:{formData:{type:Array}},data:function(){return{duties:[]}},created:function(){var t;null===(t=this.formData)||void 0===t||t.push(this.getExperienceObject())},methods:{getExperienceObject:function(){return{uuid:Object(F["v4"])(),location:null,from:null,to:null,position:null,house_size:null,number_of_adult:null,age_of_adult:null,number_of_children:null,age_of_children:null,number_of_elderly:null,age_of_elderly:null,duties:[],status:"finished"}}}},de=fe,ve=(a("e4c3"),Object(m["a"])(de,T,I,!1,null,"f085198c",null)),ge=ve.exports,_e=a("9a25"),be=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("section",{staticClass:"IdentityDocumentInfoForm row"},[a("h5",{staticClass:"col-12"},[t._v("Visa Info")]),a("div",{staticClass:"form-group col-6"},[a("label",[t._v("Passport")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.passport,expression:"formData.passport"}],staticClass:"form-control",attrs:{name:"passport",type:"text"},domProps:{value:t.formData.passport},on:{input:function(e){e.target.composing||t.$set(t.formData,"passport",e.target.value)}}})]),a("div",{staticClass:"form-group col-6"},[a("label",[t._v("HK ID")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.hk_id,expression:"formData.hk_id"}],staticClass:"form-control",attrs:{name:"hk_id",type:"text"},domProps:{value:t.formData.hk_id},on:{input:function(e){e.target.composing||t.$set(t.formData,"hk_id",e.target.value)}}})]),a("div",{staticClass:"form-group col-6"},[a("label",[t._v("Visa Expiry Date")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.visa_expiry_date,expression:"formData.visa_expiry_date"}],staticClass:"form-control",attrs:{name:"visa_expiry_date",type:"date"},domProps:{value:t.formData.visa_expiry_date},on:{input:function(e){e.target.composing||t.$set(t.formData,"visa_expiry_date",e.target.value)}}})]),a("div",{staticClass:"form-group col-6"},[a("label",[t._v("HK ID Expiry Date")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.hk_id_expiry_date,expression:"formData.hk_id_expiry_date"}],staticClass:"form-control",attrs:{name:"hk_id",type:"date"},domProps:{value:t.formData.hk_id_expiry_date},on:{input:function(e){e.target.composing||t.$set(t.formData,"hk_id_expiry_date",e.target.value)}}})])])},ye=[],he={name:"IdentityDocumentInfoForm",props:{formData:{type:Object,required:!0}},data:function(){return{current_country:null,nationalities:[]}},computed:{states:function(){return{hong_kong:["Central and Western","Eastern","Southern","Wan Chai","Sham Shui Po","Kowloon City","Kwun Tong","Wong Tai Sin","Yau Tsim Mong","Islands","Kwai Tsing","North","Sai Kung","Sha Tin","Tai Po","Tsuen Wan","Tuen Mun","Yuen Long"],indonesia:["Aceh","Bali","Bangka Belitung Islands","Banten","Bengkulu","Central Java","Central Kalimantan","Central Sulawesi","East Java","East Kalimantan","East Nusa Tenggara","Gorontalo","Special Capital Region of Jakarta","Jambi","Lampung","Maluku","North Kalimantan","North Maluku","North Sulawesi","North Sumatra","Papua","Riau","Riau Islands","Southeast Sulawesi","South Kalimantan","South Sulawesi","South Sumatra","West Java","West Kalimantan","West Nusa Tenggara","West Papua","West Sulawesi","West Sumatra","Special Region of Yogyakarta"]}}},created:function(){this.fetchNationalities()},methods:{fetchNationalities:function(){var t=this;re["a"].get(ie["a"].nationalities).then((function(e){var a=e.data;return t.nationalities=a})).catch((function(t){return console.log(t)}))}}},De=he,Ce=Object(m["a"])(De,be,ye,!1,null,"0456c651",null),xe=Ce.exports,Se=a("ac8f"),$e=a("6506"),ke={name:"CreateNewApplicantForm",props:{formData:{type:Object,required:!0}},watch:{formData:{immediate:!0,deep:!0,handler:function(t){"hong_kong"===(null===t||void 0===t?void 0:t.current_country)&&(this.formData.experience[0].current_country="hong_kong")}}},components:{ApplicantQuestionsForm:$e["a"],HolidayArrangementForm:Se["a"],JobInfoForm:K["a"],ExperienceInfoForm:ge,BasicInfoForm:N,FamilyInfoForm:j["a"],IdentityDocumentInfoForm:xe,EducationInfoForm:_e["a"]},methods:{addExperience:function(t){Array.isArray(this.formData.experience)||(this.formData.experience=[]),this.formData.experience.push(t)},removeExperience:function(t){this.formData.experience=this.formData.experience.filter((function(e){return e.uuid!==t}))}}},Ee=ke,Ae=Object(m["a"])(Ee,n,o,!1,null,"7678d832",null);e["a"]=Ae.exports}}]);