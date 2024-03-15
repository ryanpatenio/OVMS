const ImageCard = () =>{
    return(
        <div>
            <div className="text-center mt-2 mb-4">
                <h2 className="fw-bolder">What we offer?</h2>
            </div>
            <div className="row gx-5">
                <Card title={"Security"} category={"Features"} description={"A reliable Online Voting WebSite! We secure all the Data and Privacy of the user!"} image={"https://tse4.mm.bing.net/th?id=OIP.ZA0EDtB9oVe1Y182AHh6cQHaE8&pid=Api&P=0&h=220"} link={"#!"} />
                <Card title={"Electronic Voting"} category={"Features"} description={"A fast Phased Voting Website that you can get the result faster and stays protected from double Voting!"} image={"https://media.istockphoto.com/photos/wave-of-coloured-lights-picture-id182197837?k=6&m=182197837&s=612x612&w=0&h=ZcTQCAKgyg5ukYOuW9CQLqJGDh6lfhBGFcx2KOAAoA4="} link={"#!"} />
                <Card title={"Easy to Vote!"} category={"Features"} description={"The Voters can easily access the Web application and it is responsive Web app that can use in any Android or Apple devices!."} image={"https://www.westend61.de/images/0001186009pw/smiling-man-using-cell-phone-in-the-city-DIGF06980.jpg"} link={"#!"} />
            </div>
        </div>
    )
}


const Card =({category, title, description, image, link})=> {
    return(
        <div className="col-lg-4 mb-5">
                    <div className="card h-100 shadow border-0">
                        <img className="card-img-top"
                            src={image}
                            alt="..." />
                        <div className="card-body p-4">
                            <div className="badge bg-primary bg-gradient rounded-pill mb-2">{category}</div>
                            <a className="text-decoration-none link-dark stretched-link" href={link}>
                                <h5 className="card-title mb-3">{title}</h5>
                            </a>
                            <p className="card-text mb-0">{description}</p>
                        </div>

                    </div>
                </div>
    );
}

export {ImageCard};