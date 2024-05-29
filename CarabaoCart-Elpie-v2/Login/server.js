const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware for parsing JSON requests
app.use(bodyParser.json());

// Endpoint for sending approval emails
app.post('/send-approval-email', (req, res) => {
    const { email } = req.body;


    const transporter = nodemailer.createTransport({
        service: 'gmail',
        auth: {
            user: 'g.landoyelpie@gmail.com',
            pass: '1234567'
        }
    });

    const mailOptions = {
        from: 'g.landoyelpie@gmail.com',
        to: email,
        subject: 'Password Reset Request',
        text: 'Please approve the password reset request.'
    };

    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            console.error('Error:', error);
            res.status(500).send('Failed to send approval email.');
        } else {
            console.log('Email sent: ' + info.response);
            res.status(200).send('Approval email sent successfully.');
        }
    });
});

// Start the server
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
