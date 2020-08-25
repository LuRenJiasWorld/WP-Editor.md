import MainInterface from 'src/main.type';
import { LoaderStatus } from "src/utils/enum";

export default interface AppInterface extends MainInterface {
  authorize: {
    authorize_token: string,
    authorized: boolean,
  },

  user: {
    userName: string,
    email: string,
    disk_usage_byte: number,
    disk_limit_byte: number,
  },

  endpoint_url: string;

  getUserInfo : () => Promise<boolean>;
  getImageList: () => Promise<boolean>;
  toggleLoader: (status: LoaderStatus) => void;

  deleteImage       : (hash: string)  => void;
  copyLink          : (url: string)   => void;
  downloadImage     : (
                        url: string,
                        filename: string,
                      )               => void;
  openImageInNewTab : (url: string)   => void;

  mounted     : () => void; 
}