from spire.doc import *
from spire.doc.common import *

# Create a Document object
document = Document()

input_file = sys.argv[1]

output_file = sys.argv[2]
# Load a Word DOCX file
document.LoadFromFile(input_file)
# Or load a Word DOC file
#document.LoadFromFile("Sample.doc")

# Convert the document to a list of image streams
image_streams = document.SaveImageToStreams(ImageType.Bitmap)

# Incremental counter
i = 1

# Save each image stream to a PNG file
image_streams[0]
image_name ="storage/app/public/previews/"+output_file
with open(image_name,'wb') as image_file:
    image_file.write(image_streams[0].ToArray())

# Close the document
document.Close()