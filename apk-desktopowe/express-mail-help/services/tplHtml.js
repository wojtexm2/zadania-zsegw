module.exports = function(req,resp){
	resp.render('index', {
		pTitle: 'Dokument szablonu HTML',
		pBody: 'Body',
		pIfs: false,
		pTab: [1, 2, 3, 'Jedynka'],
		pLorem: '<p>Lorem <b>chipsum</b> ship Dolores</p>',
		pObs: {a:5, b:10, c:15}
	})
}
