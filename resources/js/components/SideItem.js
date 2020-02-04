// TableRow.js

import React, { Component } from "react";
import {
  BrowserRouter as Router,
  Route,
  NavLink,
  Link
} from "react-router-dom";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

import {
  faCheck
} from "@fortawesome/free-solid-svg-icons";

export default class SideItem extends Component {

  constructor(props) {
    super(props);
    this.state = {
      checked: false
    };
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
              <div className="pretty p-jelly">
                <input
                  type="checkbox"
                  id={`checkbox_${this.props.lecture.number}`}
                  onChange={(event) => this.handleChange(event)}
                  checked={this.state.checked}
                />
                <div className="state p-success">
                  <label></label>
                </div>
              </div>
            </div>
          </li>


        </React.Fragment>
      );
    }
  }
}
