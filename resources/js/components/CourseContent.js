import React, { Component } from 'react';
import { BrowserRouter as Router, Route, NavLink } from "react-router-dom";

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faArrowRight, faArrowLeft } from "@fortawesome/free-solid-svg-icons";
import Media from './CourseMedia';

export default class CourseContent extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="page-content container-fluid">

                <div className="row">
                    <div className="col-xl-6 col-md-12 col-sm-12 col-12">
                        <h1 className="page-title">{this.props.lecture.section_title}</h1>
                        <h4 className="lecture-title">{this.props.lecture.title}</h4>
                    </div>
                </div>

                <div className="row media-container">
                    <Media lecture={this.props.lecture} />
                </div>

                <div className="d-flex justify-content-between">
                    <div>
                        <NavLink className={`btn btn-learna btn-learna-primary ${!this.props.lecture.prev ? "disabled" : ""}`} to={this.props.lecture.prev ? this.props.lecture.prev : '#'}><FontAwesomeIcon icon={faArrowLeft} /> Anterior</NavLink>
                    </div>
                    <div>
                        <NavLink className={`btn btn-learna btn-learna-primary ${!this.props.lecture.next ? "disabled" : ""}`} to={this.props.lecture.next ? this.props.lecture.next : '#'}>Pŕoxima <FontAwesomeIcon icon={faArrowRight} /></NavLink>
                    </div>
                </div>

            </div>
        );
    }
}

