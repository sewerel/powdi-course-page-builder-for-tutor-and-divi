import React, { ReactElement } from 'react';

// Icon data.
{/* <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="2" y="5" width="12" height="4" rx="0.5" stroke="black"/>
<path d="M2 3H14" stroke="black" stroke-linecap="round"/>
<path d="M2 11H14" stroke="black" stroke-linecap="round"/>
<path d="M2 13H14" stroke="black" stroke-linecap="round"/>
</svg>
 */}


const name = 'divi-tutor/content'; // Unique name.
const viewBox = '0 0 16 16'; // You will need to adjust this to match your SVG.
const component = () => (
    <>
        <rect x="2" y="5" width="12" height="4" rx="0.5" stroke="black" fill="none" />
        <path d="M2 3H14" stroke="black" stroke-linecap="round" />
        <path d="M2 11H14" stroke="black" stroke-linecap="round" />
        <path d="M2 13H14" stroke="black" stroke-linecap="round" />
    </>

); // Your SVG path. without the svg tag.


export default {
    name,
    viewBox,
    component,
};