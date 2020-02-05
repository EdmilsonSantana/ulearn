// TableRow.js

import React, { Component } from "react";
import {
  BrowserRouter as Router,
  Route,
  NavLink,
  Link
} from "react-router-dom";
import Checkbox from './Checkbox';
import LectureService from "../services/LectureService";

export default class SideItem extends Component {

  constructor(props) {
    super(props);
    this.state = {
      checked: false
    };
    this.service = new LectureService(site_url);
  }

  handleChange(event) {
    this.setState({ checked: event.target.checked });
  }
  
  render() {
    const is_section = this.props.lecture.is_section;

    if (is_section) {
      return (
        <li className="site-menu-category">
          Seção {this.props.lecture.number} - {this.props.lecture.s_title}
        </li>
      );
    } else {
      return (
        <React.Fragment>
          <li className={`site-menu-item d-flex flex-row align-items-center`}>

            <NavLink
              to={base_url + "/" + this.props.lecture.url}
            >
              <article>
                <div className="pl-2">
                  Atividade {this.props.lecture.number}:{" "}
                  {this.props.lecture.l_title}
                </div>
              </article>
            </NavLink>
            <div className="ml-auto">
              <Checkbox id={this.props.lecture.number} 
                  initialChecked={this.props.lecture.completion_status}
                  onChange={checked => this.service.updateLectureStatus(this.props.lecture, checked)} />
            </div>
          </li>


        </React.Fragment>
      );
    }
  }
}
