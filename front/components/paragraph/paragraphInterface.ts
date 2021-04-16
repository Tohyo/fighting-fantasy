import { BookInterface } from "../book/bookInterface";
import { EncouterInterface } from "../encounter/encounterInterface";
import { LinkedParagraphInterface } from "./linkedParagraphInterface";

export interface ParagraphInterface {
  id: string
  number: number
  text: string
  encounters: EncouterInterface[]
  linkedParagraphs: LinkedParagraphInterface[]
  book: BookInterface
}
