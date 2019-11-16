import React from "react";

export default class CourseCard extends React.Component {
  render() {
    const ratings = [1, 2, 3, 4, 5];

    return (
      <div className="course-block mx-auto">
        <a href={this.props.route}>
          <main>
            <img src={this.props.thumbImage} />
            <div className="col-md-12">
              <h6 className="course-title">{this.props.title}</h6>
            </div>

            <div className="instructor-clist">
              <div className="col-md-12">
                <i className="fa fa-chalkboard-teacher"></i>&nbsp;
                <span>
                  Created by <b>{this.props.instructor}</b>
                </span>
              </div>
            </div>
          </main>
          <footer>
            <div className="c-row">
              <div className="col-md-6 col-sm-6 col-6">
                <h5 className="course-price">
                  {this.props.price}
                  &nbsp;
                  <s>
                    {this.props.strikeOutPrice
                      ? this.props.strikeOutPrice
                      : ""}
                  </s>
                </h5>
              </div>
              <div className="col-md-5 offset-md-1 col-sm-5 offset-sm-1 col-5 offset-1">
                <div className="course-rating">
                  {ratings.map((rating, index) => (
                    <span key={index}
                      className={`fa fa-star ${
                        rating <= this.props.averageRating ? "checked" : ""
                      } `}
                    ></span>
                  ))}
                </div>
              </div>
            </div>
          </footer>
        </a>
      </div>
    );
  }
}
