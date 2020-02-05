import React from 'react';

export default (props) => {
    const [checked, setChecked] = React.useState(props.initialChecked);

    return (
        <div className="pretty p-jelly">
            <input
                type="checkbox"
                id={`checkbox_${props.id}`}
                onChange={(event) => {
                    let checked = event.target.checked;

                    props.onChange(checked)
                        .then(() => setChecked(checked));
                }}
                checked={checked}
            />
            <div className="state p-success">
                <label></label>
            </div>
        </div>
    );
}