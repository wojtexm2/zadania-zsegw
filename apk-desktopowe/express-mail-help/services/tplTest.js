module.exports = function(req,resp){
	resp.render('index', {
		pTitle: 'Strona szablonowa',
		pBody: 'Jestem pan Peebody',
		pIfs: false,
		pTab: [1, 2, 3, 'Start!'],
		pLorem: '<p>Lorem <b>chipsum</b> ship Dolores</p>',
		pObs: {a:5, b:10, c:15}
	})
}
