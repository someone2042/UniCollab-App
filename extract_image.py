# from spire.presentation.common import *
# from spire.presentation import *

# # Check if a filename is provided as an argument
# if len(sys.argv) < 2:
#   print("Usage: extract_image.py <presentation_file>")
#   exit(1)

# # Get the presentation filename from argv
# presentation_filename = sys.argv[1]

# # Create a Presentation object
# presentation = Presentation()

# # Load the PowerPoint presentation
# presentation.LoadFromFile(presentation_filename)

# # Extract only the first slide
# slide = presentation.Slides[0]

# # Specify the output filename (without index)
# output_filename = sys.argv[2]

# # Save the first slide as a PNG image
# image = slide.SaveAsImage()
# image.Save(output_filename)
# image.Dispose()

# presentation.Dispose()

# print(f"Extracted first image to: {output_filename}")

import os
from spire.presentation.common import *
from spire.presentation import *

# Get file and destination folder from command-line arguments
if len(sys.argv) < 4:
    print("Usage: python extract_image.py <input_file.pptx> <output_folder>")
    exit(1)

input_file = sys.argv[1]
output_folder = sys.argv[2]

# Create a Presentation object
presentation = Presentation()

# Load a PowerPoint presentation
presentation.LoadFromFile(input_file)

# Extract only the first slide
slide = presentation.Slides[0]

# Specify the output file name
filename = os.path.join(output_folder, sys.argv[3])  # Adjust filename if needed

# Save the slide as a PNG image
image = slide.SaveAsImage()
image.Save(filename)
image.Dispose()

presentation.Dispose()

print(f"Extracted first image to: {filename}")
