const util = require('util')
const fs = require('fs');

// converts a Cake Job into a viewable object
// with body property double escaping removed
// paste the job copied from redis here.

const job = { "body": "{\"class\":[\"App\\\\Job\\\\AddUserJob\",\"execute\"],\"args\":[{\"full_name\":\"James McDonald\",\"email\":\"james@toggen.com.au\"}],\"data\":{\"full_name\":\"James McDonald\",\"email\":\"james@toggen.com.au\"}}", "properties": { "enqueue.topic": "add_user", "enqueue.content_type": "application\/json" }, "headers": { "message_id": "d49fa59b-a548-4922-8dbe-823cdbcb20b5", "timestamp": 1660996809, "reply_to": null, "correlation_id": null, "attempts": 0 } }

job.body = JSON.parse(job.body);

fs.writeFile('output.json', JSON.stringify(job), err => {
    if (err) {
        console.error(err);
    }
    // file written successfully
});

console.log(
    util.inspect(job, { showHidden: false, depth: null, colors: true })
);