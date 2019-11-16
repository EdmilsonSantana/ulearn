import React, { Component } from "react";
import ReactDOM from "react-dom";
import CourseCard from "./CourseCard";
import Fade from "react-reveal/Fade";

export default class CoursesTab extends Component {
  constructor(props) {
    super(props);
    this.state = { categories: [], courses: { data: [], preferences: {} } };
  }

  getCategories() {
    axios
      .get(`${this.props.site_url}/api/category`)
      .then(response => {
        this.setState({ categories: response.data });
      })
      .catch(function(error) {
        console.log(error);
        return (window.location.href = this.props.site_url);
      });
  }

  getCoursesByCategory(categoryId) {
    console.log(categoryId);
    axios
      .get(`${this.props.site_url}/api/category/${categoryId}/courses`)
      .then(response => {
        console.log(response.data);
        this.setState({ courses: response.data });
      })
      .catch(function(error) {
        console.log(error);
        return (window.location.href = this.props.site_url);
      });
  }

  componentDidMount() {
    this.getCategories();
  }

  render() {
    return (
      <React.Fragment>
        <nav className="clearfix secondary-nav seperator-head">
          <ul className="secondary-nav-ul list mx-auto nav">
            {this.state.categories.map((category, index) => (
              <li key={index} className="nav-item">
                <a
                  data-toggle="tab"
                  role="tab"
                  onClick={() => this.getCoursesByCategory(category.id)}
                  className={`nav-link ${index == 0 ? "active" : ""}`}
                >
                  {category.name}
                </a>
              </li>
            ))}
          </ul>
        </nav>

        <div className="container tab-content">
          <div className="row">
            {this.state.courses.data.length > 0 ? (
              this.state.courses.data.map((course, index) => (
                <div
                  key={index}
                  className="col-xl-3 col-lg-4 col-md-6 col-sm-6"
                >
                  <Fade left>
                    <CourseCard
                      title={course.course_title}
                      average_rating={course.average_rating}
                      instructor={`${course.first_name} ${course.last_name}`}
                      route={`${this.props.site_url}/course-view/${course.course_slug}`}
                      thumbImage={
                        course.thumb_image
                          ? course.thumb_image
                          : this.state.courses.preferences.default_thumb
                      }
                      price={
                        course.price
                          ? `${this.state.courses.preferences.defaultCurrency ||
                              ""}${course.price}`
                          : "Free"
                      }
                      strikeOutPrice={course.strike_out_price}
                    />
                  </Fade>
                </div>
              ))
            ) : (
              <div className="empty-courses-message">Aguardem novos cursos em breve!</div>
            )}
          </div>
        </div>
      </React.Fragment>
    );
  }
}

if (document.getElementById("course_tabs")) {
  const course_tabs = document.getElementById("course_tabs");

  const site_url = course_tabs.getAttribute("data-site-url");
  let base_url = window.location.pathname;

  console.log(site_url);

  ReactDOM.render(
    <CoursesTab
      base_url={base_url.slice(0, base_url.lastIndexOf("/"))}
      site_url={site_url}
    />,
    course_tabs
  );
}
