// TableRow.js

import React, { Component } from "react";
import {
  BrowserRouter as Router,
  Route,
  NavLink,
  Link
} from "react-router-dom";
import Checkbox from './Checkbox';

export default class SideItem extends Component {

  constructor(props) {
    super(props);
    
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
        <li className="site-menu-item">
          <NavLink
           onClick={e => e.stopPropagation()}
            to={base_url + "/" + this.props.lecture.url}
            activeClassName="active"
          >
            <article>
              <div className="d-flex flex-row align-items-center">
                <Checkbox id={this.props.lecture.number} />

                <div className="pl-2">
                  Atividade {this.props.lecture.number}:{" "}
                  {this.props.lecture.l_title}
                </div>
              </div>
            </article>
          </NavLink>
        </li>
      );
    }
  }
}
