/**
 * @license Copyright (c) 2014-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

import { ClassicEditor } from "@ckeditor/ckeditor5-editor-classic"

import { Alignment } from "@ckeditor/ckeditor5-alignment"
import { Bold, Italic } from "@ckeditor/ckeditor5-basic-styles"
import type { EditorConfig } from "@ckeditor/ckeditor5-core"
import { Essentials } from "@ckeditor/ckeditor5-essentials"
import { Heading } from "@ckeditor/ckeditor5-heading"
import { AutoLink, Link } from "@ckeditor/ckeditor5-link"
import { List } from "@ckeditor/ckeditor5-list"
import { MediaEmbed } from "@ckeditor/ckeditor5-media-embed"
import { Paragraph } from "@ckeditor/ckeditor5-paragraph"
import { PasteFromOffice } from "@ckeditor/ckeditor5-paste-from-office"
import { Table, TableToolbar } from "@ckeditor/ckeditor5-table"
import { TextTransformation } from "@ckeditor/ckeditor5-typing"
import { Undo } from "@ckeditor/ckeditor5-undo"
import { SourceEditing } from "@ckeditor/ckeditor5-source-editing"
import { GeneralHtmlSupport } from '@ckeditor/ckeditor5-html-support';

// You can read more about extending the build with additional plugins in the "Installing plugins" guide.
// See https://ckeditor.com/docs/ckeditor5/latest/installation/plugins/installing-plugins.html for details.

class Editor extends ClassicEditor {
    public static override builtinPlugins = [
        Alignment,
        AutoLink,
        Bold,
        Essentials,
        GeneralHtmlSupport,
        Heading,
        Italic,
        Link,
        List,
        MediaEmbed,
        Paragraph,
        PasteFromOffice,
        Table,
        TableToolbar,
        TextTransformation,
        Undo,
        SourceEditing,
    ]

    public static override defaultConfig: EditorConfig = {
        toolbar: {
            items: [
                "undo",
                "redo",
                "heading",
                "|",
                "bold",
                "italic",
                "link",
                "bulletedList",
                "numberedList",
                "alignment",
                "|",
                "insertTable",
                "mediaEmbed",
                "sourceEditing",
            ],
        },
        language: "ru",
        table: {
            contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
        },
        heading: {
            options: [
                {
                    model: "paragraph",
                    title: "Параграф",
                    class: "ck-heading_paragraph",
                },
                {
                    model: "heading1",
                    view: "h1",
                    title: "Заголовок 1",
                    class: "ck-heading_heading1",
                },
                {
                    model: "heading2",
                    view: "h2",
                    title: "Заголовок 2",
                    class: "ck-heading_heading2",
                },
                {
                    model: "heading3",
                    view: "h3",
                    title: "Заголовок 3",
                    class: "ck-heading_heading3",
                },
            ],
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        }
    }
}

export default Editor
