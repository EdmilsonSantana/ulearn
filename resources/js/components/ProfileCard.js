import React, { Component } from "react";

export default class ProfileCard extends Component {
  render() {
    return (
      <div className="profile-card py-3 card shadow text-center">
        <div className="card-body py-4">
          <img
            className="profile-picture rounded-circle"
            src={this.props.imageSrc}
          />
          <h2 className="h6 font-weight-bold mt-3 mb-1">
            {this.props.title}
          </h2>
          <p className="text-muted text-uppercase">
            {this.props.subtitle}
          </p>
          <p className="profile-description px-3 mt-4">{this.props.description}</p>
        </div>
      </div>
    );
  }
}

/*

    Social Section
<div class="d-flex social-section justify-content-center">
    <a class="text-warning" href=""><i class="fa fa fa-instagram"></i></a>
    <a class="text-warning" href=""><i class="fa fa fa-facebook"></i></a>
    <a class="text-warning" href=""><i class="fa fa fa-twitter"></i></a>
    <a class="text-warning" href=""><i class="fa fa fa-linkedin"></i></a>
    <a class="text-warning" href=""><i class="fa fa fa-google-plus"></i></a>
    <a class="text-warning" href=""><i class="fa fa fa-whatsapp"></i></a>
</div>
*/
