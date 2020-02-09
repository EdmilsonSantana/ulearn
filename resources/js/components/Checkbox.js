import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

export default (props) => {
    const [checked, setChecked] = React.useState(props.initialChecked);

    const handleChange = (event) => {
        let checked = event.target.checked;

        props.onChange(checked)
            .then(() => setChecked(checked));
    };

    return (
        <div className="pretty p-icon p-jelly p-thick">
            <input
                type="checkbox"
                id={`checkbox_${props.id}`}
                onChange={handleChange}
                checked={checked}
            />
            <div className="state p-info">
                <i className="icon"><FontAwesomeIcon icon="check"></FontAwesomeIcon></i>
                <label></label>
            </div>
        </div>
    );
}