const conf = require('../etc/conf')

const winUser = function(req, resp){
	resp.send('Self-test in console...')
	console.log('App is working')
	console.log('name: '+conf.name)
	console.log('url: http//localhost')
	console.log('port: '+conf.port)
}

module.exports = winUser
