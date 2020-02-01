import React from "react";

export default props => {
  const [checked, setChecked] = React.useState(false);

  const handleChange = event => {
    console.log(event.target.checked);
    setChecked(event.target.checked);
    console.log(event.target.checked);
  };

  const handleClick = event => {
    //console.log(event.target.checked);
    //setChecked(event.target.checked);
    event.preventDefault();
  };

  return (
    <div className="pretty p-default">
      <input
        type="checkbox"
        id={props.id}
        onClick={handleClick}
        onChange={handleChange}
        checked={checked}
      />
      <div className="state">
        <label></label>
      </div>
    </div>
  );
};
