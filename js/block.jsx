import Highlighter from "./Highlighter.jsx";
const  { registerBlockType } = wp.blocks;
const  { __ } = wp.i18n;

registerBlockType(
    'rtsyntaxdemo/syntaxhighlighter', {
        title: __( 'Rt Syntax Highlighter' ),
        icon: 'megaphone',
        category: 'widgets',
        attributes: {
            content: {
                type: 'string'
            },
            language: {
                type: 'string',
                default: 'php'
            },
            theme: {
                type: 'string',
                default: 'default'
            },
            raw_content: {
                type: 'array',
                source: 'children',
                selector: '.code-highlight',
            }
        },
        save( { attributes } ) {
            return(
                <div>
                    <link rel="stylesheet" href={ rtsyntax.path + 'css/' + attributes.theme + '.css' } />
                    <div className='code-highlight hljs'>{attributes.raw_content}</div>
                </div>
            );
        },
        edit: Highlighter
    },
);
