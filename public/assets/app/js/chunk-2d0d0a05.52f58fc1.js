(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0d0a05"],{"697c":function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"TemplateIndex"},[a("CCard",[a("CCardHeader",{staticClass:"d-flex justify-content-between align-content-center"},[a("h5",{staticClass:"m-0"},[t._v("All Templates")]),a("router-link",{staticClass:"btn btn-success btn-sm",attrs:{to:{name:"Create Template"}}},[a("i",{staticClass:"fa fa-plus"}),t._v(" Template ")])],1),a("CCardBody",{staticClass:"table-responsive"},[a("CDataTable",{attrs:{items:t.templates,fields:t.fields,"column-filter":"","table-filter":"","items-per-page-select":"","items-per-page":15,hover:"",sorter:"",pagination:""},scopedSlots:t._u([{key:"tags",fn:function(e){var s=e.item;return[a("td",t._l(s.tags,(function(e,s){return a("span",{key:s,staticClass:"badge badge-info p-1"},[t._v(t._s(e))])})),0)]}},{key:"actions",fn:function(e){var s=e.item;return[a("td",[a("router-link",{staticClass:"btn btn-info btn-sm",attrs:{to:{name:"Template",params:{id:s.id}}}},[a("i",{staticClass:"fa fa-eye"}),t._v(" Show ")])],1)]}}])})],1)],1)],1)},n=[],r=a("83d5"),i=a("7ed9"),l={label:null,tags:[]},c={name:"TemplateIndex",data:function(){return{isLoading:!0,fields:[{key:"label",label:name},{key:"tags"},{key:"actions",sorter:!1,filter:!1}],formData:Object.assign({},l)}},computed:{templates:function(){return this.$store.getters["template/templates"]}},created:function(){this.$store.dispatch("template/fetchTemplates")},methods:{submit:function(){var t=this;i["a"].post(r["a"].store,this.formData).then((function(){return t.$toasted.success("New applicant created")})).then((function(){return t.formData=Object.assign({},l)})).catch((function(e){return t.$toasted.error("Cannot create applicant. "+e.message)}))}}},o=c,u=a("2877"),d=Object(u["a"])(o,s,n,!1,null,"05952dad",null);e["default"]=d.exports}}]);