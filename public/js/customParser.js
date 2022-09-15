function attachmentParser(block) {
    return `<div><a href="${block.data.file}" download">Tải file đính kèm</a></div>`;
}

function imageParser(block) {
    return `<img class="image-inline" style="max-width: 60%;max-height: 50%"  src="${block.data.file.url}">`
}
