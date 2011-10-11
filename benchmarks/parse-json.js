var fs = require("fs");

console.time('all');
console.time('json.read');


fs.readFile('example.json', function (err, json){
	console.timeEnd('json.read');
	console.time('json.parse');

	var messages = JSON.parse(json).data.messages;

	console.timeEnd('json.parse');
	console.time('json.transform');

	var clone = messages.map(function (msg){
		var obj = {};
		for( var key in msg ){
			obj[key] = msg[key];
		}
		return obj;
	});

	console.timeEnd('json.transform');
	console.timeEnd('all');
});
