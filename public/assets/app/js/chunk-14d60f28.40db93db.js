(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-14d60f28"],{"98d2":function(t,a,e){"use strict";e("a1b9")},a1b9:function(t,a,e){},df0e:function(t,a,e){"use strict";e.r(a);var r=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"VariantTemplate"},[t.product?e("div",[e("h1",[t._v("Print template for "+t._s(t.product.name)+" ("+t._s(t.variant.name)+")")]),e("ckeditor",{attrs:{editor:t.editor,config:t.editorConfig},model:{value:t.editorData,callback:function(a){t.editorData=a},expression:"editorData"}}),e("div",{staticClass:"row mt-2"},[e("div",{staticClass:"col-12"},[e("button",{staticClass:"btn btn-success",on:{click:t.submit}},[t._v("Submit")])])])],1):e("div",[e("h1",{staticClass:"text-center"},[t._v("Loading...")])])])},n=[],i=e("7ed9"),o=e("babe"),s=e("6930"),c=e.n(s),d=e("fb3d"),u=e.n(d),p={name:"VariantTemplate",components:{ckeditor:c.a.component},data:function(){return{product:null,variant:null,editor:u.a,editorData:"",editorConfig:{typing:{transformations:{remove:["arrowLeft","arrowRight"]}}}}},created:function(){var t=this;i["a"].get(o["a"].show_product_variants(this.$route.params.product_id,this.$route.params.variant_id)).then((function(a){var e=a.data;t.product=e.product,t.variant=e.variant})).catch((function(a){return t.$toasted.error(a.message)})),i["a"].get(o["a"].load_variant_template(this.$route.params.product_id,this.$route.params.variant_id)).then((function(a){var e=a.data;return t.editorData=e})).catch((function(a){return t.$toasted.error(a.message)}))},methods:{submit:function(){var t=this,a={variant_id:this.$route.params.variant_id,content:this.editorData.replace(/&gt;/gi,">")};i["a"].post(o["a"].add_template(this.product.id),a).then((function(){return t.$toasted.success("Updated Template")})).catch((function(a){return t.$toasted.error(a.message)}))}}},l=p,m=(e("98d2"),e("2877")),v=Object(m["a"])(l,r,n,!1,null,null,null);a["default"]=v.exports}}]);