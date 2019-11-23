import React, { Component } from "react";
import ReactDOM from "react-dom";
import {
  CarouselProvider,
  Slider,
  Slide,
  ButtonBack,
  ButtonNext
} from "pure-react-carousel";
import "pure-react-carousel/dist/react-carousel.es.css";
import ProfileCard from "./ProfileCard";

export default class TestimonialsList extends Component {
  constructor(props) {
    super(props);
    this.state = {
      testimonials: [
        {
          user_image: "https://randomuser.me/api/portraits/women/50.jpg",
          user_name: "Sarah Smith",
          depoiment:
            " Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC."
        },
        {
          user_image: "https://randomuser.me/api/portraits/men/10.jpg",
          user_name: "John Watson",
          depoiment:
            " Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC."
        },
        {
          user_image: "https://randomuser.me/api/portraits/men/9.jpg",
          user_name: "Lenny Kravitz",
          depoiment:
            "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC."
        }
      ]
    };
  }

  render() {
    return (
      <React.Fragment>
        <CarouselProvider
          naturalSlideWidth={3}
          naturalSlideHeight={1}
          totalSlides={2}
        >
          <div className="carousel-slider-container">
            <Slider>
              <Slide index={0}>
                <div className="d-flex flex-row justify-content-center flex-nowrap">
                  {this.state.testimonials.map((testimonial, index) => (
                    <div className="p-2" key={index}>
                      <ProfileCard
                        key={index}
                        imageSrc={testimonial.user_image}
                        title={testimonial.user_name}
                        description={testimonial.depoiment}
                      />
                    </div>
                  ))}
                </div>
              </Slide>
            </Slider>
            <ButtonBack className="btn btn-default">
              <i className="fa fa-chevron-left"></i>
            </ButtonBack>
            <ButtonNext className="btn btn-default">
              <i className="fa fa-chevron-right"></i>
            </ButtonNext>
          </div>
        </CarouselProvider>
      </React.Fragment>
    );
  }
}

if (document.getElementById("testimonials_list")) {
  const testimonialsList = document.getElementById("testimonials_list");

  const siteUrl = testimonialsList.getAttribute("data-site-url");
  let baseUrl = window.location.pathname;

  ReactDOM.render(
    <TestimonialsList
      baseUrl={baseUrl.slice(0, baseUrl.lastIndexOf("/"))}
      siteUrl={siteUrl}
    />,
    testimonialsList
  );
}
