(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-44b33cb6"],{"366c":function(e,t,a){"use strict";a.r(t);var o=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"JobIndex"},[a("CCard",[a("CCardHeader",{staticClass:"d-flex justify-content-between align-content-center"},[a("h5",{staticClass:"m-0"},[e._v("All Jobs")])]),a("CCardBody",[a("CreateNewForm")],1)],1)],1)},r=[],s=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("CCard",[a("CCardBody",[a("form",{staticClass:"form",on:{submit:function(t){return t.preventDefault(),e.submit.apply(null,arguments)}}},[a("fieldset",[a("legend",[e._v("Basic Info")]),a("div",{staticClass:"row"},[a("SimpleSelect",{attrs:{label:"Prefix",size:"col-3 col-md-2",options:e.prefixOptions},model:{value:e.formData.prefix,callback:function(t){e.$set(e.formData,"prefix",t)},expression:"formData.prefix"}}),a("TextInput",{attrs:{size:"col-md-5",label:"First Name"},model:{value:e.formData.first_name,callback:function(t){e.$set(e.formData,"first_name",t)},expression:"formData.first_name"}}),a("TextInput",{attrs:{size:"col-md-5",label:"Last Name"},model:{value:e.formData.last_name,callback:function(t){e.$set(e.formData,"last_name",t)},expression:"formData.last_name"}}),a("TextInput",{attrs:{label:"Mobile Number",required:""},model:{value:e.formData.mobile,callback:function(t){e.$set(e.formData,"mobile",t)},expression:"formData.mobile"}})],1)]),a("fieldset",[a("legend",[e._v("Job Info")]),a("div",{staticClass:"form-group"},[a("label",[e._v("Request service")]),a("div",{staticClass:"row"},[a("div",{staticClass:"btn-group btn-group-toggle btn-group-justified col-12",attrs:{"data-toggle":"buttons"}},e._l(e.service_types,(function(t){return a("label",{key:t.value,staticClass:"btn btn-outline-info",class:{active:t.value===e.formData.service_type}},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.service_type,expression:"formData.service_type"}],attrs:{type:"radio"},domProps:{value:t.value,checked:e._q(e.formData.service_type,t.value)},on:{change:function(a){return e.$set(e.formData,"service_type",t.value)}}}),e._v(" "+e._s(t.label)+" ")])})),0)])]),"people"===e.formData.service_type?a("people-job-order-form",{attrs:{"form-data":e.formData.people},on:{"update:formData":function(t){return e.$set(e.formData,"people",t)},"update:form-data":function(t){return e.$set(e.formData,"people",t)},inputUpdated:e.updatePeopleInput}}):e._e(),"other"===e.formData.service_type?a("section",[a("div",{staticClass:"form-group"},[a("label",[e._v("Other Services")]),a("select",{directives:[{name:"model",rawName:"v-model",value:e.formData.other.services,expression:"formData.other.services"}],staticClass:"form-control",attrs:{multiple:""},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.$set(e.formData.other,"services",t.target.multiple?a:a[0])}}},[a("option",[e._v("Insurance")]),a("option",[e._v("Ticket")])])]),a("div",{staticClass:"form-group"},[a("label",[e._v("Note")]),a("textarea",{directives:[{name:"model",rawName:"v-model",value:e.formData.other.note,expression:"formData.other.note"}],staticClass:"form-control",domProps:{value:e.formData.other.note},on:{input:function(t){t.target.composing||e.$set(e.formData.other,"note",t.target.value)}}})])]):e._e()],1),a("button",{staticClass:"btn btn-success",attrs:{type:"subimt"}},[e._v("Submit")])])])],1)},l=[],n=a("fad9"),i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{class:e.size},[a("div",{staticClass:"form-group"},[a("label",[e._v(e._s(e.label))]),a("input",{staticClass:"form-control",attrs:{placeholder:e.placeholder,required:e.required},domProps:{value:e.value},on:{input:function(t){return e.$emit("input",t.target.value)}}})])])},c=[],u={name:"TextInput",props:{label:{type:String,required:!0},value:{type:String,default:""},placeholder:{type:String,default:""},required:{type:Boolean,default:!1},size:{type:String,default:"col-12"}}},m=u,p=a("2877"),d=Object(p["a"])(m,i,c,!1,null,"4399feb1",null),f=d.exports,v=a("767d"),_=a("7ed9"),b=a("cecc"),g={name:"CreateNewForm",components:{PeopleJobOrderForm:n["a"],TextInput:f,SimpleSelect:v["a"]},data:function(){return{formData:{prefix:"ms",first_name:null,last_name:null,mobile:null,service_type:"people",people:{type:"no_preference",note:"",nationality:null,duties:[],personalities:[]},other:{services:[],note:""}},service_types:[{label:"People",value:"people"},{label:"Other",value:"other"}],prefixOptions:[{label:"Mr.",value:"mr"},{label:"Ms.",value:"ms"},{label:"Mrs.",value:"mrs"}]}},methods:{updatePeopleInput:function(e){this.formData.people[e.key]=e.value},submit:function(){var e=this;_["a"].post(b["a"].list,this.formData).then((function(){e.$toasted.success("Job created successfully"),e.$router.push({name:"Jobs"})})).catch((function(t){e.$toasted.error(t.message)}))}}},y=g,D=Object(p["a"])(y,s,l,!1,null,"1c41506e",null),C=D.exports,h={name:"JobCreate",components:{CreateNewForm:C}},x=h,w=Object(p["a"])(x,o,r,!1,null,"770ada81",null);t["default"]=w.exports},"767d":function(e,t,a){"use strict";var o=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"SimpleSelect form-group",class:e.size},[a("label",[e._v(e._s(e.label))]),a("select",{staticClass:"form-control",attrs:{name:"english",multiple:e.multiple},on:{input:e.updateSelect}},[e.showPlaceholder?a("option",{domProps:{value:null,selected:null===e.value}},[e._v(" -- Please Select -- ")]):e._e(),e._l(e.options,(function(t){return a("option",{key:t.value,domProps:{value:t.value,selected:e.isSelected(t)}},[e._v(" "+e._s(t.label)+" ")])}))],2)])},r=[],s=a("2ef0"),l={name:"SimpleSelect",props:{label:{type:String},name:{type:String},options:{type:Array,default:function(){return[]}},size:{type:String,default:"col-12 col-md-4"},multiple:{type:Boolean},value:{type:String,default:null},defaultValue:{type:String,default:null}},data:function(){return{id:Object(s["random"])("10000","99999")}},computed:{showPlaceholder:function(){return!this.defaultValue}},methods:{isSelected:function(e){return e.value===this.value},updateSelect:function(e){this.$emit("input",e.target.value)}}},n=l,i=a("2877"),c=Object(i["a"])(n,o,r,!1,null,"5ae3eaa7",null);t["a"]=c.exports},c48f:function(e,t,a){"use strict";var o={list:"/api/agencycore/clients",show:function(e){return"/api/agencycore/clients/".concat(e)},new_job:function(e){return"/api/agencycore/clients/".concat(e,"/jobs")},duties:"/api/agencycore/duties/all",personalities:"/api/agencycore/personalities",new_client_and_job:"/api/agencycore/new_client_and_job",client_addresses:function(e){return"/api/agencycore/clients/".concat(e,"/addresses")},update_address:function(e,t){return"/api/agencycore/clients/".concat(e,"/addresses/").concat(t)}};t["a"]=o},cecc:function(e,t,a){"use strict";var o={list:"/api/agencycore/jobs",show:function(e){return"/api/agencycore/jobs/".concat(e)},duties:"/api/agencycore/duties/all",nationalities:"/api/agencycore/nationalities",potential_applicants:"/api/agencycore/applicants/available",all_assigned_applicants:function(e){return"/api/agencycore/jobs/".concat(e,"/applicants/all")},assign_applicant:function(e){return"/api/agencycore/jobs/".concat(e,"/applicants")},remove_applicant:function(e,t){return"/api/agencycore/jobs/".concat(e,"/applicants/").concat(t)},email_applicant:function(e){return"/api/agencycore/jobs/".concat(e,"/applicants/email")},update_requirement:function(e){return"/api/agencycore/jobs/".concat(e,"/update_requirement")},comments:function(e){return"/api/agencycore/jobs/".concat(e,"/comments")}};t["a"]=o},fad9:function(e,t,a){"use strict";var o=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("section",[a("div",{staticClass:"form-group"},[a("label",[e._v("Type")]),a("div",{staticClass:"row"},[a("div",{staticClass:"btn-group btn-group-toggle btn-group-justified col-12",attrs:{"data-toggle":"buttons"}},e._l(e.people_types,(function(t){return a("label",{key:t.value,staticClass:"btn btn-outline-info",class:{active:t.value===e.formData.type}},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.type,expression:"formData.type"}],attrs:{type:"radio",name:"type"},domProps:{value:t.value,checked:e._q(e.formData.type,t.value)},on:{change:function(a){return e.$set(e.formData,"type",t.value)}}}),e._v(" "+e._s(t.label)+" ")])})),0)])]),a("div",{staticClass:"form-group"},[a("label",[e._v("Nationality")]),a("select",{directives:[{name:"model",rawName:"v-model",value:e.formData.nationality,expression:"formData.nationality"}],staticClass:"form-control",on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.$set(e.formData,"nationality",t.target.multiple?a:a[0])}}},[a("option",{domProps:{value:null}},[e._v("No preference")]),e._l(e.nationalities,(function(t){return a("option",{key:t.value,domProps:{value:t.value,textContent:e._s(t.label)}})}))],2)]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"house_size"}},[e._v("Expected Arrival Date")]),a("div",{staticClass:"input-group col"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.expected_arrival_date,expression:"formData.expected_arrival_date"}],staticClass:"form-control",attrs:{type:"date",min:"today",id:"expected_arrival_date",name:"expected_arrival_date"},domProps:{value:e.formData.expected_arrival_date},on:{input:function(t){t.target.composing||e.$set(e.formData,"expected_arrival_date",t.target.value)}}})])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"house_size"}},[e._v("House Size")]),a("div",{staticClass:"input-group col"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.house_size,expression:"formData.house_size"}],staticClass:"form-control",attrs:{type:"number",min:"0",id:"house_size",placeholder:"House size eg: 750",name:"house_size"},domProps:{value:e.formData.house_size},on:{input:function(t){t.target.composing||e.$set(e.formData,"house_size",t.target.value)}}}),e._m(0)])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"number_of_rooms"}},[e._v("Number of rooms")]),a("div",{staticClass:"input-group col"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.number_of_rooms,expression:"formData.number_of_rooms"}],staticClass:"form-control",attrs:{type:"number",min:"0",id:"number_of_rooms",placeholder:"Number of rooms eg:3",name:"garden_size"},domProps:{value:e.formData.number_of_rooms},on:{input:function(t){t.target.composing||e.$set(e.formData,"number_of_rooms",t.target.value)}}})])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"garden_size"}},[e._v("Garden")]),a("div",{staticClass:"input-group col"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.garden_size,expression:"formData.garden_size"}],staticClass:"form-control",attrs:{type:"number",min:"0",id:"garden_size",placeholder:"Garden size eg:500",name:"garden_size"},domProps:{value:e.formData.garden_size},on:{input:function(t){t.target.composing||e.$set(e.formData,"garden_size",t.target.value)}}}),e._m(1)])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"number_of_cars"}},[e._v("Wash Car")]),a("div",{staticClass:"col"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.number_of_cars,expression:"formData.number_of_cars"}],staticClass:"form-control",attrs:{type:"number",min:"0",id:"number_of_cars",name:"garden_size"},domProps:{value:e.formData.number_of_cars},on:{input:function(t){t.target.composing||e.$set(e.formData,"number_of_cars",t.target.value)}}})])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"disabled_personnel"}},[e._v("Disability")]),a("div",{staticClass:"col"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.disabled_personnel,expression:"formData.disabled_personnel"}],staticClass:"form-control",attrs:{type:"number",min:"0",id:"disabled_personnel",name:"garden_size"},domProps:{value:e.formData.disabled_personnel},on:{input:function(t){t.target.composing||e.$set(e.formData,"disabled_personnel",t.target.value)}}})])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"disabled_personnel"}},[e._v("Number of expecting babies")]),a("div",{staticClass:"col"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.number_of_expecting_babies,expression:"formData.number_of_expecting_babies"}],staticClass:"form-control",attrs:{type:"number",min:"0",id:"number_of_expecting_babies",name:"garden_size"},domProps:{value:e.formData.number_of_expecting_babies},on:{input:function(t){t.target.composing||e.$set(e.formData,"number_of_expecting_babies",t.target.value)}}})])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"number_of_kids"}},[e._v("Number of children (0-5)")]),a("div",{staticClass:"col-3 col-sm-4"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.number_of_kids,expression:"formData.number_of_kids"}],staticClass:"form-control",attrs:{type:"number",min:"0",placeholder:"Number of kids. eg: 2",id:"number_of_kids",name:"number_of_kids"},domProps:{value:e.formData.number_of_kids},on:{input:function(t){t.target.composing||e.$set(e.formData,"number_of_kids",t.target.value)}}})]),a("div",{staticClass:"col-3 col-sm-4"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.age_of_kids,expression:"formData.age_of_kids"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Age of kids: 2, 5",id:"age_of_kids",name:"age_of_kids"},domProps:{value:e.formData.age_of_kids},on:{input:function(t){t.target.composing||e.$set(e.formData,"age_of_kids",t.target.value)}}})])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-6 col-sm-4 col-form-label",attrs:{for:"number_of_young_adults"}},[e._v("Number of children (6-18)")]),a("div",{staticClass:"col-3 col-sm-4"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.number_of_young_adults,expression:"formData.number_of_young_adults"}],staticClass:"form-control",attrs:{type:"number",min:"0",placeholder:"Number of kids. eg: 3",id:"number_of_young_adults",name:"number_of_young_adult"},domProps:{value:e.formData.number_of_young_adults},on:{input:function(t){t.target.composing||e.$set(e.formData,"number_of_young_adults",t.target.value)}}})]),a("div",{staticClass:"col-3 col-sm-4"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.age_of_young_adults,expression:"formData.age_of_young_adults"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Age of kids: 8, 10, 15",id:"age_of_young_adults",name:"age_of_young_adult"},domProps:{value:e.formData.age_of_young_adults},on:{input:function(t){t.target.composing||e.$set(e.formData,"age_of_young_adults",t.target.value)}}})])]),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:"pets"}},[e._v("Pets")]),a("div",{staticClass:"col"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.formData.pets,expression:"formData.pets"}],staticClass:"form-control",attrs:{type:"text",placeholder:"1 cats, 2 dogs",id:"pets",name:"pets"},domProps:{value:e.formData.pets},on:{input:function(t){t.target.composing||e.$set(e.formData,"pets",t.target.value)}}})])]),a("div",{staticClass:"form-group"},[a("label",[e._v("Note")]),a("textarea",{directives:[{name:"model",rawName:"v-model",value:e.formData.note,expression:"formData.note"}],staticClass:"form-control",domProps:{value:e.formData.note},on:{input:function(t){t.target.composing||e.$set(e.formData,"note",t.target.value)}}})])])},r=[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"input-group-append"},[a("div",{staticClass:"input-group-text"},[e._v("ft"),a("sup",[e._v("2")])])])},function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"input-group-append"},[a("div",{staticClass:"input-group-text"},[e._v("ft"),a("sup",[e._v("2")])])])}],s=a("7ed9"),l=a("c48f"),n=a("4a7a"),i=a.n(n),c=(a("6dfc"),{name:"PeopleJobOrderForm",components:{vSelect:i.a},props:{formData:{type:Object,required:!0}},data:function(){return{people_types:[{label:"No preference",value:"no_preference"},{label:"Local",value:"local"},{label:"Overseas",value:"overseas"}],nationalities:[{label:"Indonesian",value:"IH"},{label:"Filipino",value:"FH"},{label:"Bangladeshi",value:"BH"},{label:"Sri Lankan",value:"SH"},{label:"Cambodian",value:"CH"}],duties:[],selected_duties:[]}},created:function(){var e=this;s["a"].get(l["a"].duties).then((function(t){var a=t.data;return e.duties=a})).catch((function(e){return console.log(e)}))}}),u=c,m=a("2877"),p=Object(m["a"])(u,o,r,!1,null,"7dcb262a",null);t["a"]=p.exports}}]);