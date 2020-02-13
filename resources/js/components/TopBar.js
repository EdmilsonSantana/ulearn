import React, { Component } from "react";
import ModalRating from "./ModalRating";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

export default class TopBar extends Component {
  render() {
    return (
      <nav
        className="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-expand-lg"
        role="navigation"
      >
        <div className="navbar-header">
          <button
            type="button"
            className="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
            data-toggle="menubar"
          >
            <span className="sr-only">Toggle navigation</span>
            <span className="hamburger-bar"></span>
          </button>
          <div
            className="navbar-brand navbar-brand-center site-gridmenu-toggle active"
            data-toggle="gridmenu"
            aria-expanded="true"
          >
            <img
              className="navbar-brand-logo"
              src={site_url + "/backend/assets/images/logo.png"}
              title="Uniautomóvel"
            />
            <span className="navbar-brand-text hidden-xs-down">
              {" "}
              Uniautomóvel
            </span>
          </div>
        </div>

        <div className="navbar-container container-fluid pl-0 pr-0">
          <div
            className="collapse navbar-collapse navbar-collapse-toolbar"
            id="site-navbar-collapse"
          >
            <ul className="nav navbar-toolbar">
              <li className="nav-item hidden-float" id="toggleMenubar">
                <a
                  className="nav-link "
                  data-toggle="menubar"
                  href={site_url + "/course-learn/" + course_slug}
                  role="button"
                >
                  <FontAwesomeIcon icon="arrow-left" /> &nbsp;Voltar
                </a>
              </li>
              <li className="ml-auto nav-item hidden-float">
                <ModalRating />
              </li>
            </ul>
          </div>
        </div>
      </nav>
    );
  }
}
