(self.webpackChunk=self.webpackChunk||[]).push([[927],{6303:(e,t,l)=>{"use strict";l.d(t,{Z:()=>s});var n=l(3645),a=l.n(n)()((function(e){return e[1]}));a.push([e.id,".lighten[data-v-5ac4a098]{background-color:#bfffb9}.l-table[data-v-5ac4a098]{background-color:#fff;overflow-x:auto;padding:5px}.l-table table[data-v-5ac4a098]{border-collapse:collapse;width:100%}.l-table table td[data-v-5ac4a098],.l-table table th[data-v-5ac4a098]{border-bottom:1px solid #eee;padding:5px;text-align:center}.l-table table th[data-v-5ac4a098]{min-width:100px}",""]);const s=a},7228:(e,t,l)=>{"use strict";l.r(t),l.d(t,{default:()=>p});const n={props:{value:{type:Array},items:{type:Array,default:function(){return[]}},headers:{type:Array},search:{type:String},options:{type:Array},totals:{type:Array},inputs:{type:Boolean},selectable:{type:Boolean,default:!1}},data:function(){return{select_all:""}},computed:{_headers:function(){return this.headers.map((function(e){var t=e.split("|");return{text:t[0],align:"right",value:t.length>1?t[1]:t[0]}}))}},methods:{setTest:function(e){this.$emit("input",this.items.filter((function(e){return 1==e.___selected})))},setSelectAll:function(){var e=this;this.items.forEach((function(t){return t.___selected=!e.select_all})),this.$emit("input",this.items.filter((function(e){return 1==e.___selected})))},getValue:function(e,t){for(var l=(t=(t=t.replace(/\[(\w+)\]/g,".$1")).replace(/^\./,"")).split("."),n=0,a=l.length;n<a;++n){var s=l[n];if(!(s in e))return;e=e[s]}return e}}};var a=l(3379),s=l.n(a),r=l(6303),c={insert:"head",singleton:!1};s()(r.Z,c);r.Z.locals;var i=l(1900),o=l(3453),u=l.n(o),_=l(422),d=(0,i.Z)(n,(function(){var e=this,t=e.$createElement,l=e._self._c||t;return l("div",{staticClass:"l-table"},[l("table",[l("thead",[e.selectable?l("td",{staticStyle:{width:"30px"}},[l("input",{directives:[{name:"model",rawName:"v-model",value:e.select_all,expression:"select_all"}],attrs:{type:"checkbox"},domProps:{checked:Array.isArray(e.select_all)?e._i(e.select_all,null)>-1:e.select_all},on:{input:function(t){return e.setSelectAll()},change:function(t){var l=e.select_all,n=t.target,a=!!n.checked;if(Array.isArray(l)){var s=e._i(l,null);n.checked?s<0&&(e.select_all=l.concat([null])):s>-1&&(e.select_all=l.slice(0,s).concat(l.slice(s+1)))}else e.select_all=a}}})]):e._e(),e._v(" "),e._l(e._headers,(function(t,n){return l("th",{key:n},[e._v(e._s(e.$t(t.text)))])})),e._v(" "),e.options&&e.options.length>0?l("th",[e._v(e._s(e.$t("options")))]):e._e()],2),e._v(" "),l("tbody",[e.inputs?l("tr",[e._l(e._headers,(function(t,n){return l("td",{key:n},[e._t("input-"+t.value)],2)})),e._v(" "),l("td",[e._t("input-options")],2)],2):e._e(),e._v(" "),e._l(e.items,(function(t,n){return l("tr",{key:n},[e.selectable?l("td",{staticStyle:{width:"30px"}},[l("input",{directives:[{name:"model",rawName:"v-model",value:t.___selected,expression:"item.___selected"}],attrs:{type:"checkbox"},domProps:{checked:Array.isArray(t.___selected)?e._i(t.___selected,null)>-1:t.___selected},on:{change:[function(l){var n=t.___selected,a=l.target,s=!!a.checked;if(Array.isArray(n)){var r=e._i(n,null);a.checked?r<0&&e.$set(t,"___selected",n.concat([null])):r>-1&&e.$set(t,"___selected",n.slice(0,r).concat(n.slice(r+1)))}else e.$set(t,"___selected",s)},function(l){return e.setTest(t)}]}})]):e._e(),e._v(" "),e._l(e._headers,(function(n,a){return l("td",{key:a},[e._t(n.value,(function(){return[e._v("\n\t\t\t\t\t\t"+e._s(e.getValue(t,n.value))+"\n\t\t\t\t\t")]}),{item:t})],2)})),e._v(" "),e.options&&e.options.length>0?l("td",[e.options.includes("show")?l("v-icon",{staticClass:"ml-2",attrs:{color:"blue"},on:{click:function(l){return e.$emit("show",t)}}},[e._v("mdi-eye ")]):e._e(),e._v(" "),e.options.includes("edit")?l("v-icon",{staticClass:"ml-2",attrs:{color:"blue"},on:{click:function(l){return e.$emit("edit",t)}}},[e._v("mdi-pencil ")]):e._e(),e._v(" "),e.options.includes("remove")?l("v-icon",{staticClass:"ml-2",attrs:{color:"red"},on:{click:function(l){return e.$emit("remove",t)}}},[e._v(" mdi-delete ")]):e._e()],1):e._e()],2)})),e._v(" "),e.totals?l("tr",e._l(e._headers,(function(t,n){return l("td",{key:n,class:{lighten:e.totals.includes(t.value)}},[e.totals.includes(t.value)?l("span",[e._v(" "+e._s(e.items.reduce((function(e,l){return e+parseInt(l[t.value])}),0))+" ")]):e._e()])})),0):e._e(),e._v(" "),e._t("totals")],2)])])}),[],!1,null,"5ac4a098",null);const p=d.exports;u()(d,{VIcon:_.Z})}}]);