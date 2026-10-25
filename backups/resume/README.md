# Personal Curriculum Vitae Website
This is the source code for my personal website, which is built using Express and Node.js, and deployed on [Render](https://render.com/).

## Features

- Responsive design for optimal viewing on any device
- Customizable color scheme
- Option to display my resume in PDF format
- Links to my social media profiles and projects

## Getting Started

1. Clone the repository: `git clone https://github.com/giacomo-secchi/resume.git`
2. Install the dependencies: `npm install`
3. Start the server locally for development: `npm start`
4. Navigate to http://localhost:3000/
5. Deploy the code to your Render service

## Deployment

This application is automatically deployed to [Fly.io](https://fly.io) on every push to the `main` branch.

To pull the remote Fly.io's Dockerfile use the official **[Fly.io Dockerfile Generator](https://fly.io/javascript-journal/demystify-docker-js/)** for Node.js applications.

## Customization

You can customize the color scheme of the website by editing the `src/scss/styles.scss` file.

You can also replace the resume PDF file in the `public` folder with your own.

## Built With

- [Express](https://expressjs.com/)
- [Node.js](https://nodejs.org/)
- [Fly.io](https://fly.io)

## References

I took inspiration for the microdata structure from this guide: https://webdesign.tutsplus.com/how-to-create-an-html5-microdata-powered-resume--net-22046t.

## Authors

- Giacomo Secchi - [GitHub](https://github.com/giacomo-secchi)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
